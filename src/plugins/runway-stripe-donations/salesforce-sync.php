<?php

add_action('runway_stripe_salesforce_sync_hook', array('RunwayStripeSalesforceSync', 'sync'));

class RunwayStripeSalesforceSync {


  public static function sync() {
    runway_stripe_record_message('Salesforce sync starting', 'Salesforce');

    try {
      $options = get_option('runway_stripe_options');
      $client = self::get_client($options);

      self::send_error_emails();

      self::sync_campaigns($client);

      do {
        $synced_contacts = self::fetch_contacts_and_sync($client, $options);
      } while($synced_contacts > 0);

      do {
        $synced_donations = self::fetch_donations_and_sync($client, $options);
      } while($synced_donations > 0);

      self::send_error_emails();

      runway_stripe_record_message('Salesforce sync complete', 'Salesforce');
    } catch (SoapFault $ex) {
      runway_stripe_record_error('Salesforce error: '.$ex->getMessage(), $ex->getTraceAsString(), 'Salesforce');
    } catch (Exception $ex) {
      runway_stripe_record_error($ex->getMessage(), $ex->getTraceAsString(), 'Salesforce');
    }
  }

  private static function fetch_contacts_and_sync($client, $options) {
    global $wpdb;

    $donations = $wpdb->get_results(
      // We order by created_dt so that recurring donations are processed in chronological order.
      $wpdb->prepare(
        "SELECT id,
          charge_id,
          TRIM(email_address) email_address,
          name,
          address_line_1,
          address_line_2,
          address_city,
          address_state,
          address_country,
          address_zip,
          phone_number,
          created_dt,
          recurring
        FROM {$wpdb->prefix}runway_stripe_data
        WHERE salesforce_contact_id IS NULL
        AND salesforce_sync_error IS NULL
        AND account_id = %d
        AND created_dt >= %s
        AND successful = 1
        AND TRIM(email_address) != ''
        AND amount > 0
        ORDER BY created_dt
        LIMIT 200", // 200 is the most Salesforce can take in one go.
        array(
          $options['salesforce_stripe_account'],
          $options['salesforce_after_date']
        )
      )
    );

    if(count($donations) > 0) {
      runway_stripe_record_message('Checking '.count($donations).' donation rows with Salesforce for contacts', 'Salesforce');

      // ----- PREPARE OUR DATA -----

      // This first one only contains only the last donation with each email address
      // NOTE: The indexing functions here also lowercase the email address
      $indexed_donations = self::index_by_value($donations, 'email_address');
      // This one contains an array of donations for each email address
      $multi_indexed_donations = self::multi_index_by_value($donations, 'email_address');
      $indexed_existing_contacts = self::get_contacts_from_salesforce($client, array_keys($indexed_donations));

      // ----- DETECT AND CARRY OUT REQUIRED UPDATES -----

      // Look at the contacts we got back - do we need to update them, or just record the contact ID in our DB?
      $updates_needed = array();
      foreach ($indexed_existing_contacts as $email_address => $contact) {
        $fields_to_update = self::get_contact_fields_needing_updating($contact, $multi_indexed_donations[$email_address]);
        if(count(get_object_vars($fields_to_update)) > 0) {
          // We need to update the values in Salesforce. Prepare the object to be sent to Salesforce.
          $fields_to_update->Id = $contact->Id;
          $fields_to_update->Email = $email_address; // This is needed to match the donations up with the contact in process_contact_response.
          array_push($updates_needed, $fields_to_update);
        } else {
          // Record the contact ID in our database. For those that need updating we save the ID once that's
          // been done. This happens through the process_contact_response function.
          self::save_salesforce_ids($contact->Id, $multi_indexed_donations[$email_address], 'salesforce_contact_id');
        }
      }
      if(count($updates_needed)) {
        $response = $client->update($updates_needed, 'Contact');
        self::process_contact_response($response, $updates_needed, $multi_indexed_donations);
      }

      // ----- DETECT AND CARRY OUT REQUIRED INSERTS -----

      // Email addresses that are in our DB but not in the list returned by Salesforce
      $inserts_needed = array_diff(array_keys($indexed_donations), array_keys($indexed_existing_contacts));
      // Reset the indexes
      $inserts_needed = array_values($inserts_needed);
      if(count($inserts_needed)) {
        runway_stripe_record_message(count($inserts_needed).' contacts to be created in Salesforce', 'Salesforce');

        // Insert these missing contacts
        $get_donation = function ($email) use ($indexed_donations) { return $indexed_donations[$email]; };
        $donations_to_insert = array_map($get_donation, $inserts_needed);
        $records_to_insert = array_map('self::salesforce_contact_record_from_donation', $donations_to_insert);
        $response = $client->create($records_to_insert, 'Contact');

        self::process_contact_response($response, $records_to_insert, $multi_indexed_donations);
      }
    }

    return count($donations);
  }

  private static function fetch_donations_and_sync($client, $options) {
    global $wpdb;

    $donations = $wpdb->get_results(
      // We order by created_dt so that recurring donations are processed in chronological order.
      $wpdb->prepare(
        "SELECT id,
          charge_id,
          TRIM(email_address) email_address,
          name,
          amount,
          IF(recurring = 1, stripe_customer_id, NULL) recurring_customer_id,
          TRIM(campaign) campaign,
          created_dt,
          salesforce_contact_id
        FROM {$wpdb->prefix}runway_stripe_data
        WHERE salesforce_contact_id IS NOT NULL
        AND salesforce_sync_error IS NULL
        AND salesforce_donation_id IS NULL
        AND account_id = %d
        AND created_dt >= %s
        AND successful = 1
        AND amount > 0
        ORDER BY created_dt
        LIMIT 20", // 200 is the most Salesforce can take in one go, BUT Salesforce seems to take a long time generating donations for recurring donations at that sort of batch size.
        array(
          $options['salesforce_stripe_account'],
          $options['salesforce_after_date']
        )
      )
    );

    if(count($donations) > 0) {
      $contact_ids = self::pluck($donations, 'salesforce_contact_id');
      $indexed_accounts = self::get_contact_account_ids_from_salesforce($client, $contact_ids);

      // Fetch donations that already exist for these charge IDs
      $indexed_donations = self::index_by_value($donations, 'charge_id', true);
      $indexed_existing_sf_donations = self::get_donations_from_salesforce($client, array_keys($indexed_donations));

      $all_campaign_names = self::pluck($donations, 'campaign');
      $indexed_campaigns = self::get_campaigns_from_salesforce($client, $all_campaign_names);
      list($indexed_recurring_donations_ids, $new_recurring_donations) = self::ensure_all_recurring_donations_created(
        $client,
        self::index_by_value($donations, 'recurring_customer_id', true),
        $indexed_campaigns
      );
      if($new_recurring_donations > 0) {
        // After creating recurring donations we need to give Salesforce a little time
        // to auto-generate the donations.
        sleep($new_recurring_donations);
      }

      // ----- MATCH AGAINST EXISTING DONATIONS BY STRIPE ID (PROBABLY ONLY NEEDED IF WE WIPE OUT OUR DB) -----

      if(count($indexed_existing_sf_donations)) {
        runway_stripe_record_message('Matching '.count($indexed_existing_sf_donations).' existing donations in Salesforce', 'Salesforce');
        foreach ($indexed_existing_sf_donations as $charge_id => $sf_donation) {
          // Record the donation ID in our database. For one-off donations there aren't any scenarios in which
          // we'd want to update the donation data in Salesforce after it's been imported.
          self::save_salesforce_ids($sf_donation->Id, array($indexed_donations[$charge_id]), 'salesforce_donation_id');
          // Remove this item from the array so that it's not included in processing by later code.
          unset($indexed_donations[$charge_id]);
        }
      }

      // ----- MATCH AGAINST AUTO-GENERATED REPEATING DONATIONS -----

      // When a recurring donation is in use the donation objects are automatically created, so we update them rather than
      // inserting new donations.
      $updates_needed = array();
      $updated_donations = array();
      $skipped_donations = 0;
      foreach ($indexed_donations as $charge_id => $donation) {
        if($donation->recurring_customer_id) {
          $recurring_donation_id = $indexed_recurring_donations_ids[$donation->recurring_customer_id];
          $auto_generated_donation_id = self::get_donation_for_recurring_donation_from_salesforce($client, $recurring_donation_id);

          if ($auto_generated_donation_id) {
            $updates_needed[] = self::fields_to_update_for_matched_donation($auto_generated_donation_id, $donation);

            $updated_donations[$charge_id] = $donation;
          } else {
            $skipped_donations++;
          }

          // Remove this item from the array so that it's not included in processing by later code.
          unset($indexed_donations[$charge_id]);
        }
      }
      if(count($updates_needed)) {
        runway_stripe_record_message('Updating '.count($updates_needed).' auto-generated recurring donations', 'Salesforce');
        $response = $client->update($updates_needed, 'Opportunity');
        self::process_donation_response($response, $updates_needed, $updated_donations);
      }
      if($skipped_donations > 0) {
        // Salesforce STILL hasn't generated donations for these donations. Wait a little longer.
        runway_stripe_record_message($skipped_donations.' were skipped as auto-generated donations could not be found. This usually just means Salesforce needs more time to process the donations.', 'Salesforce');
        sleep($skipped_donations/2);
      }

      // ----- NOW INSERT ANYTHING THAT'S LEFT (USUALLY JUST ONE-OFF DONATIONS) -----

      // By now $indexed_donations only contains donations that are in our DB but are not in Salesforce.
      if(count($indexed_donations)) {
        runway_stripe_record_message(count($indexed_donations).' one-off donations (opportunities) to be created in Salesforce', 'Salesforce');

        $records_to_insert = array();
        foreach ($indexed_donations as $charge_id => $donation) {
          $salesforce_account_id = $indexed_accounts[$donation->salesforce_contact_id]->Account->Id;
          $salesforce_campaign_id = self::get_salesforce_campaign_id_for_donation($donation, $indexed_campaigns);

          $salesforce_recurring_donation_id = $donation->recurring_customer_id && isset($indexed_recurring_donations_ids[$donation->recurring_customer_id]) ? $indexed_recurring_donations_ids[$donation->recurring_customer_id] : null;

          $records_to_insert[] = self::salesforce_donation_record_from_donation($donation, $salesforce_account_id, $salesforce_campaign_id, $salesforce_recurring_donation_id);
        }
        $response = $client->create($records_to_insert, 'Opportunity');

        self::process_donation_response($response, $records_to_insert, $indexed_donations);
      }
    }

    return count($donations);
  }

  private static function ensure_all_recurring_donations_created($client, $donations_by_customer_id, $indexed_campaigns) {
    $recurring_donations = self::get_recurring_donations_from_salesforce($client, array_keys($donations_by_customer_id));
    $recurring_donations_ids = array_map(function ($rd) { return $rd->Id; }, $recurring_donations);

    $inserts_needed = array_diff(array_keys($donations_by_customer_id), array_keys($recurring_donations_ids));
    // Reset the indexes in $inserts_needed
    $inserts_needed = array_values($inserts_needed);

    $new_recurring_donations = array();
    if(count($inserts_needed) > 0) {
      runway_stripe_record_message(count($inserts_needed).' recurring donations to be created in Salesforce', 'Salesforce');

      $records_to_insert = array();
      foreach ($inserts_needed as $stripe_customer_id) {
        $donation = $donations_by_customer_id[$stripe_customer_id];
        $salesforce_campaign_id = self::get_salesforce_campaign_id_for_donation($donation, $indexed_campaigns);

        $records_to_insert[] = self::salesforce_recurring_donation_record_from_donation($donation, $salesforce_campaign_id);
      }
      $response = $client->create($records_to_insert, 'npe03__Recurring_Donation__c');

      $new_recurring_donations = self::process_recurring_donation_response($response, $records_to_insert, $donations_by_customer_id);

      $recurring_donations_ids = array_merge($recurring_donations_ids, $new_recurring_donations);
    }

    return array($recurring_donations_ids, count($new_recurring_donations));
  }

  private static function get_client($options) {
    require_once ('lib/salesforce/soapclient/SforceEnterpriseClient.php');

    if(!empty($options['salesforce_stripe_account']) && !empty($options['salesforce_email']) && !empty($options['salesforce_password']) && !empty($options['salesforce_security_token']) && !empty($options['salesforce_after_date']) && !empty($options['salesforce_error_email'])) {

      $client = new SforceEnterpriseClient();
      // Disable WSDL caching so that changes in our local file will be detected.
      $client->createConnection(dirname(__FILE__)."/lib/salesforce-wsdl.xml", null, array('cache_wsdl' => WSDL_CACHE_NONE));

      if(!empty($options['salesforce_sandbox'])) {
        runway_stripe_record_message('Using sandbox endpoint', 'Salesforce');
        $client->setEndpoint('https://test.salesforce.com/services/Soap/c/27.0');
      }

      $client->login($options['salesforce_email'], $options['salesforce_password'].$options['salesforce_security_token']);

      return $client;
    } else {
      throw new Exception('Salesforce login credentials not defined');
    }
  }

  private static function salesforce_query($client, $ids, $index_key, $index_is_case_sensitive, $query) {
    global $wpdb;

    if(count($ids) > 0) {
      $query = str_replace('{{ids}}', implode(', ', array_fill(0, count($ids), '%s')), $query);

      $soql_query = $wpdb->prepare($query, $ids);
      $response = $client->query($soql_query);

      return self::index_by_value($response, $index_key, $index_is_case_sensitive);
    } else {
      return array();
    }
  }

  private static function get_contacts_from_salesforce($client, $email_addresses) {
    return self::salesforce_query($client, $email_addresses, 'Email', false,
      'SELECT Id,
        FirstName,
        LastName,
        Email,
        MobilePhone,
        MailingStreet,
        MailingCity,
        MailingState,
        MailingPostalCode,
        MailingCountry,
        Monthly_Donor__c
      FROM Contact
      WHERE Email IN ({{ids}})'
    );
  }

  private static function get_contact_account_ids_from_salesforce($client, $contact_ids) {
    return self::salesforce_query($client, $contact_ids, 'Id', true,
      'SELECT Id,
        Account.Id
      FROM Contact
      WHERE Id IN ({{ids}})'
    );
  }

  private static function get_donations_from_salesforce($client, $charge_ids) {
    return self::salesforce_query($client, $charge_ids, 'StripeChargeID__c', true,
      'SELECT Id,
        StripeChargeID__c
      FROM Opportunity
      WHERE StripeChargeID__c IN ({{ids}})'
    );
  }

  private static function get_campaigns_from_salesforce($client, $campaign_names) {
    return self::salesforce_query($client, $campaign_names, 'Name', false,
      'SELECT Id,
        Name
      FROM Campaign
      WHERE Name IN ({{ids}})'
    );
  }

  private static function get_recurring_donations_from_salesforce($client, $customer_ids) {
    return self::salesforce_query($client, $customer_ids, 'StripeCustomerID__c', true,
      'SELECT Id,
        StripeCustomerID__c
      FROM npe03__Recurring_Donation__c
      WHERE StripeCustomerID__c IN ({{ids}})'
    );
  }

  private static function get_donation_for_recurring_donation_from_salesforce($client, $recurring_donation_id) {
    global $wpdb;

    // We can't rely on the CloseDate being the same as our transaction date (e.g. failed cards lead to delayed payments).
    // So we simply look for the first auto-generated donation that hasn't been linked yet.
    $soql_query = $wpdb->prepare(
      "SELECT Id
      FROM Opportunity
      WHERE npe03__Recurring_Donation__c = %s
      AND StripeChargeID__c = ''
      ORDER BY CloseDate
      LIMIT 1",
      $recurring_donation_id
    );
    $response = $client->query($soql_query);

    return count($response->records) ? $response->records[0]->Id : null;
  }

  private static function get_salesforce_campaign_id_for_donation($donation, $indexed_campaigns) {
    $get_campaign = function ($name) use ($indexed_campaigns) {
      $index = strtolower($name);
      return isset($indexed_campaigns[$index]) ? $indexed_campaigns[$index] : null;
    };

    $salesforce_campaign = null;
    if($donation->campaign) {
      $salesforce_campaign = $get_campaign($donation->campaign);
      if(!$salesforce_campaign) self::report_missing_campaign($donation->campaign, $donation);
    }

    return $salesforce_campaign ? $salesforce_campaign->Id : null;
  }

  private static function pluck($array, $key) {
    $plucked = array();
    foreach ($array as $value) {
      if(!empty($value->{$key})) {
        $plucked[] = $value->{$key};
      }
    }
    return $plucked;
  }

  private static function index_by_value($array, $key, $case_sensitive = false) {
    $indexed = array();
    foreach ($array as $value) {
      if(!empty($value->{$key})) {
        $index_value = $case_sensitive ? $value->{$key} : strtolower($value->{$key});
        $indexed[$index_value] = $value;
      }
    }
    return $indexed;
  }

  private static function multi_index_by_value($array, $key) {
    $indexed = array();
    foreach ($array as $value) {
      $loweredkey = strtolower($value->{$key});
      if(!empty($indexed[$loweredkey])) {
        array_push($indexed[$loweredkey], $value);
      } else {
        $indexed[$loweredkey] = array($value);
      }
    }
    return $indexed;
  }

  private static function salesforce_contact_record_from_donation($donation) {
    $record = new stdclass();

    $split_name = explode(' ', $donation->name, 2);
    $record->FirstName = $split_name[0];
    // LastName is required - so use the email address if we can't figure it out from our name field.
    $record->LastName = !empty($split_name[1]) ? $split_name[1] : $donation->email_address;

    $record->Email = $donation->email_address;
    $record->MobilePhone = $donation->phone_number;
    $record->npe01__PreferredPhone__c = 'Mobile';

    $record->Monthly_Donor__c = $donation->recurring == 1;

    $record->MailingStreet = $donation->address_line_1;
    $record->MailingCity = $donation->address_city;
    $record->MailingState = $donation->address_state;
    $record->MailingPostalCode = $donation->address_zip;
    $record->MailingCountry = $donation->address_country;

    return $record;
  }

  private static function get_contact_fields_needing_updating($contact, $donations) {
    $fields = new stdclass();

    foreach ($donations as $donation) {
      // We ignore LastName because it's mandatory, so the existing contact will already have a value.
      // We ignore Email because that's the field we matched on so it's already correct.
      // We don't set npe01__PreferredPhone__c because we don't know if it would override a change that an admin has made.

      self::compare_field($fields, $contact, 'MobilePhone', $donations[0], 'phone_number');

      // Contact should be marked as a regular giver if they have even one recurring donation.
      if(empty($contact->Monthly_Donor__c) && $donation->recurring == 1) {
        $fields->Monthly_Donor__c = true;
      }

      // Only set the address if the whole address is currently empty
      if(!empty($donation->MailingStreet)
          && empty($contact->MailingStreet) && empty($contact->MailingCity)
          && empty($contact->MailingState) && empty($contact->MailingPostalCode)
          && empty($contact->MailingCountry)) {

        $fields->MailingStreet = $donation->address_line_1;
        $fields->MailingCity = $donation->address_city;
        $fields->MailingState = $donation->address_state;
        $fields->MailingPostalCode = $donation->address_zip;
        $fields->MailingCountry = $donation->address_country;
      }
    }

    return $fields;
  }

  private static function compare_field($fields, $contact, $contact_field, $donation, $donation_field) {
    if(empty($contact->{$contact_field}) && !empty($donation->{$donation_field})) {
      $fields->{$contact_field} = $donation->{$donation_field};
    }
  }

  private static function salesforce_donation_record_from_donation($donation, $salesforce_account_id, $salesforce_campaign_id, $salesforce_recurring_donation_id) {
    $record = new stdclass();

    $record->Name = 'Stripe donation from '.($donation->name ? $donation->name : 'anonymous donor');
    $record->AccountId = $salesforce_account_id;
    $record->Amount = $donation->amount;
    if($salesforce_campaign_id) {
      $record->CampaignId = $salesforce_campaign_id;
    }
    if($salesforce_recurring_donation_id) {
      $record->npe03__Recurring_Donation__c = $salesforce_recurring_donation_id;
    }

    $record->StageName = 'Received';
    $record->CloseDate = $donation->created_dt;
    $record->LeadSource = 'Stripe transaction';
    $record->Type = 'Stripe Donation';
    $record->Probability = 100;

    $record->StripeChargeID__c = $donation->charge_id;

    return $record;
  }

  private static function salesforce_recurring_donation_record_from_donation($donation, $salesforce_campaign_id) {
    $record = new stdclass();

    $record->Name = 'Recurring online donation from '.($donation->name ? $donation->name : 'anonymous donor');
    $record->npe03__Contact__c = $donation->salesforce_contact_id;
    $record->npe03__Amount__c = $donation->amount;

    if($salesforce_campaign_id) {
      $record->npe03__Recurring_Donation_Campaign__c = $salesforce_campaign_id;
    }

    $record->npe03__Date_Established__c = $donation->created_dt;
    $record->npe03__Installment_Period__c = 'Monthly';
    $record->npe03__Open_Ended_Status__c = 'Open';

    $record->StripeCustomerID__c = $donation->recurring_customer_id;

    return $record;
  }

  private static function fields_to_update_for_matched_donation($salesforce_donation_id, $donation) {
    $fields = new stdclass();

    $fields->Id = $salesforce_donation_id;
    $fields->Amount = $donation->amount;

    $fields->StageName = 'Received';
    $fields->CloseDate = $donation->created_dt;
    $fields->LeadSource = 'Stripe transaction';
    $fields->Type = 'Stripe Donation';
    $fields->Probability = 100;

    $fields->StripeChargeID__c = $donation->charge_id;

    return $fields;
  }

  private static function process_contact_response($response, $records, $multi_indexed_donations) {
    foreach ($response as $i => $result) {
      // Need to be careful to use lowercased email so we're comparing like with like.
      $donations_involved = $multi_indexed_donations[strtolower($records[$i]->Email)];

      if($result->success) {
        self::save_salesforce_ids($result->id, $donations_involved, 'salesforce_contact_id');
      } else {
        self::handle_errors($result, $donations_involved);
      }
    }
  }

  private static function process_donation_response($response, $records, $indexed_donations) {
    foreach ($response as $i => $result) {
      $donation = $indexed_donations[$records[$i]->StripeChargeID__c];

      if($result->success) {
        self::save_salesforce_ids($result->id, array($donation), 'salesforce_donation_id');
      } else {
        self::handle_errors($result, array($donation));
      }
    }
  }

  private static function process_recurring_donation_response($response, $records, $donations_by_customer_id) {
    $recurring_donation_ids = array();
    foreach ($response as $i => $result) {
      $donation = $donations_by_customer_id[$records[$i]->StripeCustomerID__c];

      if($result->success) {
        $recurring_donation_ids[$records[$i]->StripeCustomerID__c] = $result->id;
      } else {
        self::handle_errors($result, array($donation));
      }
    }
    return $recurring_donation_ids;
  }

  private static function save_salesforce_ids($salesforce_id, $donations, $key) {
    global $wpdb;

    foreach ($donations as $donation) {
      $wpdb->update(
        "{$wpdb->prefix}runway_stripe_data",
        array($key => $salesforce_id),
        array('id' => $donation->id)
      );
    }
  }

  private static function sync_campaigns($client) {
    global $wpdb;

    $soql_query =
      "SELECT Id,
        Name
      FROM Campaign
      WHERE Status = 'In Progress'
      AND stayclassy__sc_event_id__c = NULL"; // Exclude Classy events.

    $existing_campaigns = $wpdb->get_results("SELECT salesforce_id, name FROM {$wpdb->prefix}runway_stripe_salesforce_campaigns;", OBJECT_K);
    $salesforce_campaigns = $client->query($soql_query);
    $seen = array();

    // Update any that have changed
    foreach ($salesforce_campaigns as $salesforce_campaign) {
      $seen[] = $salesforce_campaign->Id;

      if(isset($existing_campaigns[$salesforce_campaign->Id])) {
        // It exists in our database, do we need to update the name?
        $our_campaign = $existing_campaigns[$salesforce_campaign->Id];
        if($our_campaign->name !== $salesforce_campaign->Name) {
          runway_stripe_record_message("Updating stored campaign name from \"{$our_campaign->name}\" to \"{$salesforce_campaign->Name}\"", 'Salesforce');
          $wpdb->update(
            "{$wpdb->prefix}runway_stripe_salesforce_campaigns",
            array('name' => $salesforce_campaign->Name),
            array('salesforce_id' => $salesforce_campaign->Id)
          );
        }
      } else {
        // It's not in our database, so insert it.
        runway_stripe_record_message("Storing new campaign: \"{$salesforce_campaign->Name}\"", 'Salesforce');
        $wpdb->insert(
          "{$wpdb->prefix}runway_stripe_salesforce_campaigns",
          array('name' => $salesforce_campaign->Name, 'salesforce_id' => $salesforce_campaign->Id)
        );
      }
    }

    $to_delete = array_diff(array_keys($existing_campaigns), $seen);
    foreach ($to_delete as $salesforce_id) {
      $our_campaign = $existing_campaigns[$salesforce_id];
      runway_stripe_record_message("Deleting stored campaign: \"{$our_campaign->name}\"", 'Salesforce');

      $wpdb->delete(
        "{$wpdb->prefix}runway_stripe_salesforce_campaigns",
        array('salesforce_id' => $salesforce_id)
      );
    }
  }

  private static function handle_errors($result, $donations) {
    if (!empty($result->errors)) {
      $get_id = function ($d) { return $d->id; };
      $donation_ids = array_map($get_id, $donations);

      foreach ($result->errors as $error) {
        $fields_fragment = !empty($error->fields) ? ', Fields: '.json_encode($error->fields) : '';
        $donations_fragment = ', Donations: '.json_encode($donation_ids);
        $message = "{$error->statusCode} {$error->message}{$fields_fragment}{$donations_fragment}";

        runway_stripe_record_error($message, '', 'Salesforce');
        self::save_error_to_donation_table($message, $donation_ids);

        self::record_error_for_emailing("{$error->statusCode} {$error->message}{$fields_fragment}", $donations);
      }
    }
  }

  private static function save_error_to_donation_table($message, $donation_ids) {
    global $wpdb;

    foreach ($donation_ids as $donation_id) {
      $wpdb->update(
        "{$wpdb->prefix}runway_stripe_data",
        array('salesforce_sync_error' => $message),
        array('id' => $donation_id)
      );
    }
  }

  private static function report_missing_campaign($campaign_name, $donation) {
    self::record_error_for_emailing("There is no campaign in Salesforce named $campaign_name.", array($donation), false);
  }

  private static function record_error_for_emailing($error_message, $donations, $failure = true) {
    global $wpdb;

    $wpdb->insert(
      "{$wpdb->prefix}runway_stripe_salesforce_errors",
      array(
        'error' => $error_message,
        'is_failure' => $failure
      ),
      array(
        '%s',
        '%d'
      )
    );
    $error_id = $wpdb->insert_id;

    foreach ($donations as $donation) {
      $wpdb->insert(
        "{$wpdb->prefix}runway_stripe_salesforce_error_donation_link",
        array(
          'error_id' => $error_id,
          'donation_id' => $donation->id
        ),
        array(
          '%d',
          '%d'
        )
      );
    }
  }

  private static function send_error_emails() {
    global $wpdb;
    $options = get_option('runway_stripe_options');
    $max_error_id = get_option('runway_stripe_last_salesforce_error_sent', 0);
    $new_max_error_id = $max_error_id;

    // We send one email for each type of error
    $error_types = $wpdb->get_results(
      $wpdb->prepare(
        "SELECT e.error, e.is_failure
        FROM wphfj_runway_stripe_salesforce_error_donation_link l
        INNER JOIN wphfj_runway_stripe_salesforce_errors e
          ON l.error_id = e.id
        WHERE e.id > %d
        GROUP BY e.error,
          e.is_failure
        ",
        array(
          $max_error_id
        )
      )
    );

    foreach ($error_types as $error_type) {
      $donations = $wpdb->get_results(
        $wpdb->prepare(
          "SELECT d.*, e.created_dt error_dt, e.id error_id
          FROM wphfj_runway_stripe_salesforce_error_donation_link l
          INNER JOIN wphfj_runway_stripe_salesforce_errors e
            ON e.id = l.error_id
          INNER JOIN wphfj_runway_stripe_data d
            ON d.id = l.donation_id
          WHERE e.error = %s
          AND e.is_failure = %d
          AND e.id > %d
          ORDER BY e.created_dt
          ",
          array(
            $error_type->error,
            $error_type->is_failure,
            $max_error_id
          )
        )
      );

      $donations_text = '';
      foreach ($donations as $donation) {
        $donations_text .= "- {$donation->name}, Email: {$donation->email_address}, Donation date: {$donation->created_dt}, Stripe payment: https://dashboard.stripe.com/payments/{$donation->charge_id}, Error date: {$donation->error_dt}\n";
        if($new_max_error_id < $donation->error_id) {
          $new_max_error_id = $donation->error_id;
        }
      }

      $description = $error_type->is_failure ? 'Some Stripe donations failed to sync to Salesforce.' : 'There was a problem syncing donations to Salesforce. However, the system was still able to recover and add the donations.';

      $message = "{$description}\n\nError message: {$error_type->error}\nAffected donations:\n{$donations_text}";

      wp_mail(
        $options['salesforce_error_email'],
        "Salesforce sync error: {$error_type->error}",
        $message
      );
    }

    if(count($error_types) > 0) {
      update_option('runway_stripe_last_salesforce_error_sent', $new_max_error_id);
    }
  }
}
