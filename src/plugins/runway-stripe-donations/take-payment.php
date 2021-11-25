<?php

require_once(__DIR__.'/util.php');
require_once(__DIR__.'/vendor/autoload.php');

use Stripe\Charge;
use Stripe\Customer;
use Stripe\Plan;
use Stripe\Stripe;
use Stripe\Error\Base;
use Stripe\Error\Card;

function handle_error($msg) {
  if(isset($_POST['cancel_url'])) {
    $url = add_query_arg('error_message', urlencode($msg), $_POST['cancel_url']);
    header('Location: '.esc_url_raw($url));
  } else {
    echo $msg;
  }
  exit();
}

function handle_stripe_error($e) {
  $err = $e->getJsonBody();
  handle_error('Error processing card: '.$err['error']['message']);
}

function get_metadata_values() {
  global $runway_stripe_metadata_text_fields;
  global $runway_stripe_metadata_boolean_fields;

  $metadata = array();

  foreach ($runway_stripe_metadata_text_fields as $key) {
    if(isset($_POST[$key])) {
      $metadata[$key] = $_POST[$key];
    }
  }

  foreach ($runway_stripe_metadata_boolean_fields as $key) {
    if(isset($_POST[$key]) && ($_POST[$key] === 'on' || $_POST[$key] === 'true')) {
      $metadata[$key] = 'true';
    }
  }

  return $metadata;
}

function increment_donation_count() {
  $campaign = 'None';
  if(isset($_POST['campaign']) && $_POST['campaign']) {
    $campaign = trim($_POST['campaign']);
  }
  $option_key = 'runway_stripe_donation_count-'.sanitize_title($campaign);

  $current_value = intval(get_option($option_key, 0));
  update_option($option_key, $current_value + 1);
}

function ensure_plan_id() {
  $response = Plan::all(array("limit" => 100));
  $plans = $response->data;

  $plan_id = null;

  foreach ($plans as $plan) {
    // Remember, Stripe amounts are in integer cents.
    if($plan->amount === 100
        && $plan->currency === strtolower($_POST['currency'])
        && $plan->interval === 'month'
        && $plan->interval_count === 1) {
      $plan_id = $plan->id;
      break;
    }
  }

  if(!$plan_id) {
    $plan_id = "website_monthly_donation_".strtolower($_POST['currency']);

    Plan::create(array(
      "amount" => 100,
      "interval" => "month",
      "name" => "Online Monthly Donation ({$_POST['currency']})",
      "currency" => strtolower($_POST['currency']),
      "id" => $plan_id
    ));
  }

  return $plan_id;
}

function log_honeypot_data($account, $amount) {
  global $wpdb;
  $wpdb->insert(
    $wpdb->prefix.'runway_stripe_honeypot_log',
    array(
      'account_id' => $account,
      'ip_address' => !empty($_SERVER['HTTP_X_FORWARDED_FOR'])
                        ? $_SERVER['HTTP_X_FORWARDED_FOR']
                        : $_SERVER['REMOTE_ADDR'],
      'request_values' => json_encode($_POST),
      'amount' => $amount,
      'currency' => $_POST['currency']
    )
  );
}

runway_stripe_load_wordpress_core();
global $runway_stripe_available_currencies;
global $runway_stripe_plugin_version;

$required_values = array(
  'account',
  'donation_amount',
  'currency',
  'email',
  'monthly',
  'stripeToken',
  'cancel_url',
  'return_url'
);
foreach ($required_values as $value) {
  if(!isset($_POST[$value])) {
    handle_error("$value is not defined");
  }
}
if(!in_array($_POST['currency'], $runway_stripe_available_currencies)) {
  handle_error("{$_POST['currency']} is not a valid currency value");
}

$options = get_option('runway_stripe_options');
$account = $_POST['account'];
$amount = intval($_POST['donation_amount']);

// Do they have a valid nonce?
if (!wp_verify_nonce($_POST['_wpnonce'], 'runway-stripe-donate_take-payment')) {
  // Log the data and then show an error message.
  log_honeypot_data($account, $amount);
  handle_error('There was a problem processing your donation. Please ensure you have cookies enabled.');
} else {
  Stripe::setApiKey($options["account_{$account}_secret_key"]);
  Stripe::setAppInfo("runway-stripe-donations", $runway_stripe_plugin_version, "http://runway.io");

  try {
    $customer = Customer::create(array(
      'card' => $_POST['stripeToken'],
      'email' => $_POST['email']
    ));

    if($_POST['monthly'] == 'true') {
      // Create a repeating charge. This will be on a plan that has a charge of £1 or $1 - so quantity actually sets the amount charged.
      // Subscription metadata doesn't automatically get added to each charge, so we propagate some of it manually in runway_stripe_send_receipt_email.
      $customer->subscriptions->create(array(
        'plan' => ensure_plan_id(),
        'quantity' => $amount,
        'metadata' => get_metadata_values()
      ));
    } else {
      // Create a one-off charge
      Charge::create(array(
        'amount' => $amount * 100,
        'customer' => $customer->id,
        'currency' => $_POST['currency'],
        'metadata' => get_metadata_values()
      ));
    }

    increment_donation_count();

  } catch (Card $e) {
    handle_stripe_error($e);
  } catch (Base $e) {
    handle_stripe_error($e);
  }
}

header('Location: '.$_POST['return_url']);
