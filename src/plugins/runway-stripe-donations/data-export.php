<?php

defined('ABSPATH') or die("No script kiddies please!");

function runway_stripe_format_data_row($row) {
  $receipt_email = '';
  if($row->amount > 0) {
    if($row->receipt_email_sent) {
      $receipt_email = 'Sent';
      if($row->receipt_email_sent_dt !== '0000-00-00 00:00:00') {
        $receipt_email .= " ({$row->receipt_email_sent_dt})";
      }
    } elseif($row->receipt_email_error) {
      $receipt_email = 'Error: '.$row->receipt_email_error;
    } else {
      $receipt_email = 'Not sent';
    }
  }

  return array(
    'Charge ID' => $row->charge_id,
    'Date' => $row->created_dt,
    'Amount' => $row->amount,
    'Stripe Fee' => $row->stripe_fee,
    'Net Amount' => $row->net_amount,
    'Currency' => $row->currency,
    'Successful' => $row->successful ? 'Yes' : 'No',
    'Recurring' => $row->recurring ? 'Yes' : 'No',
    'Campaign' => $row->campaign,
    'Stripe Customer ID' => $row->stripe_customer_id,
    'Email Address' => $row->email_address,
    'Name' => $row->name,
    'Receipt Email' => $receipt_email,
    'Address Line 1' => $row->address_line_1,
    'Address Line 2' => $row->address_line_2,
    'Address City' => $row->address_city,
    'Address State' => $row->address_state,
    'Address Zip' => $row->address_zip,
    'Address Country' => $row->address_country,
    'Phone Number' => $row->phone_number,
    'Email Opt Out' => $row->email_opt_out ? 'Yes' : 'No',
    'First Name' => $row->first_name,
    'Last Name' => $row->last_name,
    'Tax ID' => $row->tax_id,
    'Gift Aid' => $row->gift_aid ? 'Yes' : 'No',
    'Custom 1' => $row->custom_1,
    'Custom 2' => $row->custom_2,
    'Custom 3' => $row->custom_3,
    'Balance Transaction ID' => $row->balance_transaction_id,
    'Transfer ID' => $row->transfer_id,
    'Transfer Date' => $row->transfer_dt,
    'Salesforce Contact ID' => $row->salesforce_contact_id,
    'Salesforce Donation ID' => $row->salesforce_donation_id,
    'Salesforce Sync Error' => $row->salesforce_sync_error
  );
}

function runway_stripe_format_aggregated_data_row($row) {
  return array(
    'Amount' => $row->amount,
    'Stripe Fee' => $row->stripe_fee,
    'Net Amount' => $row->net_amount,
    'Currency' => $row->currency,
    'Transactions' => $row->transactions,
    'Campaign' => $row->campaign,
    'Email Address' => $row->email_address,
    'Name' => $row->name,
    'Address Line 1' => $row->address_line_1,
    'Address Line 2' => $row->address_line_2,
    'Address City' => $row->address_city,
    'Address State' => $row->address_state,
    'Address Zip' => $row->address_zip,
    'Address Country' => $row->address_country
  );
}

function runway_stripe_checkbox_on($key) {
 return isset($_POST[$key]) && $_POST[$key] === 'on';
}

function runway_stripe_fetch_data($options) {
  global $wpdb;
  global $runway_stripe_date_format;
  $account = $_POST['stripe_account'];

  $where_clauses = array('account_id = %d');
  $parameters = array($account);

  // CAMPAIGN
  if($_POST['campaign'] !== 'All campaigns') {
    $where_clauses[] = 'campaign = %s';
    $parameters[] = $_POST['campaign'] === 'No campaign' ? '' : $_POST['campaign'];
  }

  // INCLUDED TRANSACTIONS
  if(runway_stripe_checkbox_on('include_refunds') && !runway_stripe_checkbox_on('include_payments')) {
    $where_clauses[] = 'amount < 0';
  } else if(!runway_stripe_checkbox_on('include_refunds') && runway_stripe_checkbox_on('include_payments')) {
    $where_clauses[] = 'amount > 0';
  }
  // else - just include everything

  // GIVERS
  if(runway_stripe_checkbox_on('include_recurring') && !runway_stripe_checkbox_on('include_one_offs')) {
    $where_clauses[] = 'recurring = true';
  } else if(!runway_stripe_checkbox_on('include_recurring') && runway_stripe_checkbox_on('include_one_offs')) {
    $where_clauses[] = 'recurring = false';
  }
  // else - just include everything

  // DATE RANGE
  $date_column = $_POST['date_type'] === 'remitted' ? 'transfer_dt' : 'created_dt';
  $where_clauses[] = "$date_column >= %s";
  $parameters[] = date($runway_stripe_date_format, strtotime($_POST['date_range_start']));
  $where_clauses[] = "$date_column < %s";
  $parameters[] = date($runway_stripe_date_format, strtotime($_POST['date_range_end']) + 24*60*60); // The end of the last day in the date range

  // SETTING UP THE QUERY
  if(!runway_stripe_checkbox_on('group_by_giver_and_campaign')) {
    $sql = "
      SELECT *
      FROM {$wpdb->prefix}runway_stripe_data
      WHERE ".implode(' AND ', $where_clauses);
    $format_function = 'runway_stripe_format_data_row';
  } else {
    $sql = "
      SELECT SUM(amount) amount,
        SUM(stripe_fee) stripe_fee,
        SUM(net_amount) net_amount,
        currency currency,
        COUNT(*) transactions,
        campaign,
        name,
        email_address,
        address_line_1,
        address_line_2,
        address_city,
        address_state,
        address_zip,
        address_country
      FROM {$wpdb->prefix}runway_stripe_data
      WHERE ".implode(' AND ', $where_clauses)."
      GROUP BY name,
        email_address,
        address_line_1,
        address_line_2,
        address_city,
        address_state,
        address_zip,
        address_country,
        campaign,
        currency";
    $format_function = 'runway_stripe_format_aggregated_data_row';
  }

  $wpdb->show_errors();

  $results = $wpdb->get_results(
    $wpdb->prepare($sql, $parameters)
  );

  return array_map($format_function, $results);
}
