<?php

require_once(__DIR__.'/util.php');
require_once(__DIR__.'/vendor/autoload.php');

use Stripe\Event;
use Stripe\Stripe;
use Stripe\Error\Base;

runway_stripe_load_wordpress_core();

global $runway_stripe_plugin_version;

$account = $_GET['account'];
$options = get_option('runway_stripe_options');
Stripe::setApiKey($options["account_{$account}_secret_key"]);
Stripe::setAppInfo("runway-stripe-donations", $runway_stripe_plugin_version, "http://runway.io");

try {
  // retrieve the request's body and parse it as JSON
  $body = @file_get_contents('php://input');
  $event_json = json_decode($body);

  // for extra security, retrieve from the Stripe API
  $event_id = $event_json->id;
  $event = Event::retrieve($event_id);

  if ($event->type == 'charge.succeeded') {
    // This also propagates some of the subscription metadata onto the charge.
    runway_stripe_send_receipt_email($event->data->object, $account, $options, true);
  }
} catch (Base $e) {
  $err = $e->getJsonBody();
  echo('Stripe error from Stripe webhook ('.$err['error']['type'].'): ' . $err['error']['message']);
} catch (Exception $e) {
  write_log('Exception from Stripe webhook: ' . $e);
}
