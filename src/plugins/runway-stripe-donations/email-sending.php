<?php

defined('ABSPATH') or die("No script kiddies please!");

use GuzzleHttp\Client;
use SparkPost\SparkPost;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Invoice;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;

function runway_stripe_send_email_to_sparkpost($api_key, $template_id, $merge_vars) {
  require_once(__DIR__.'/vendor/autoload.php');

  $httpClient = new GuzzleAdapter(new Client());
  $sparky = new SparkPost($httpClient, array('key' => $api_key));
  $result = null;

  try {
    // Build your email and send it!
    $promise = $sparky->transmissions->post(array(
      'content' => array(
        'template_id' => $template_id,
      ),
      'substitution_data' => $merge_vars,
      'inline_css' => true,
      'recipients' => array(
        array(
          'address' => array(
            'name' => $merge_vars['name'],
            'email' => $merge_vars['email']
          )
        )
      )
    ));
    $result = $promise->wait();
  } catch (\Exception $err) {
    if (function_exists('write_log')) {
      write_log('Error sending email via SparkPost: '.print_r($err, true));
    }

    $result = json_decode($err->getMessage());
  }

  return $result;
}

function runway_stripe_format_currency($amount, $currency) {
  $currency = strtoupper($currency);
  if($currency == 'NOK') {
    return "$amount kr";
  } else {
    $symbols = array(
      'EUR' => '€',
      'GBP' => '£',
      'USD' => '$',
      'ZAR' => 'R'
    );
    $symbol = $symbols[$currency];
    return "{$symbol}{$amount}";
  }
}

function runway_stripe_send_receipt_email(Charge $charge, $account, $options, $propagate_metadata) {

  $customer = Customer::retrieve($charge->customer);

  $campaign = '';
  if(isset($charge->invoice)) {
    $invoice = Invoice::retrieve($charge->invoice);
    $subscription = $customer->subscriptions->retrieve($invoice->subscription);
    $campaign = $subscription->metadata['campaign'];

    // Propagate subscription metadata onto the charge.
    if($propagate_metadata) {
      global $runway_stripe_metadata_text_fields;
      global $runway_stripe_metadata_boolean_fields;

      foreach (array_merge($runway_stripe_metadata_text_fields, $runway_stripe_metadata_boolean_fields) as $key) {
        $charge->metadata[$key] = $subscription->metadata[$key];
      }
    }
  } else {
    $campaign = $charge->metadata['campaign'];
  }

  $date_format = strtoupper($charge->currency) === 'USD' ? 'm/d/Y' : 'd/m/Y';
  $template_id = $options['sparkpost_template_id'];

  if(isset($options["account_{$account}_sparkpost_template_id"]) && $options["account_{$account}_sparkpost_template_id"]) {
    $template_id = $options["account_{$account}_sparkpost_template_id"];
  }

  $result = runway_stripe_send_email_to_sparkpost($options['sparkpost_api_key'], $template_id, array (
    'account_id' => $account,
    'name' => $charge->card->name,
    'email' => $customer->email,
    'card_last_4' => $charge->card->last4,
    'amount' => runway_stripe_format_currency(number_format($charge->amount / 100, 2), $charge->currency), // Stripe amounts are in integers of cents/pence
    'date' => date($date_format, $charge->created),
    'recurring' => isset($charge->invoice) ? 'Yes' : 'No',
    'campaign' => $campaign
  ));

  // This saves the charge object so also saves the metadata set earlier.
  runway_stripe_record_email_result($charge, $result, $customer->email);

  return $result;
}

function runway_stripe_record_email_result($charge, $result, $email) {
  global $wpdb;
  global $runway_stripe_date_format;

  $values = null;
  if (is_string($result)) {
    $values = array(
      $charge->metadata['receipt_email_sent'],
      $charge->metadata['receipt_email_sent_dt'],
      $result->message
    );
    runway_stripe_record_error("Error sending email to $email for charge {$charge->id}: {$result}", '', 'Receipt emails');
  } else {
    $values = array(true, time(), null);
    runway_stripe_record_message("Email successfully sent to $email for charge {$charge->id}", 'Receipt emails');
  }
  $charge->metadata['receipt_email_sent'] = $values[0];
  $charge->metadata['receipt_email_sent_dt'] = $values[1];
  $charge->metadata['receipt_email_error'] = $values[2];
  $charge->save(); // This also saves the metadata set earlier

  $wpdb->query(
    $wpdb->prepare(
      "UPDATE {$wpdb->prefix}runway_stripe_data
      SET receipt_email_sent = %d,
        receipt_email_sent_dt = %s,
        receipt_email_error = %s
      WHERE charge_id = %s
      AND amount > 0", // Only the original payment will have an amount bigger than 0, all refunds will have a lower amount
      $values[0] ? 1 : 0,
      $values[1] ? date($runway_stripe_date_format, $values[1]) : null,
      $values[2],
      $charge->id
    )
  );
}

function runway_stripe_send_test_email($email_address, $api_key, $template_id) {
  return runway_stripe_send_email_to_sparkpost($api_key, $template_id, array (
    'account_id' => 1,
    'name' => 'Alasdair North',
    'email' => $email_address,
    'card_last_4' => '1234',
    'amount' => '$12.34',
    'date' => '12/20/2014',
    'recurring' => 'Yes',
    'campaign' => 'Dare to be'
  ));
}
