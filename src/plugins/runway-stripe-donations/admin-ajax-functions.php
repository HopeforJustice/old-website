<?php

defined('ABSPATH') or die("No script kiddies please!");

use Stripe\Error\Base;
use Stripe\Charge;
use Stripe\Stripe;

add_action( 'admin_enqueue_scripts', 'runway_stripe_enqueue_admin_ajax' );
function runway_stripe_enqueue_admin_ajax($hook) {
  global $runway_stripe_plugin_version;

  if( 'settings_page_runway-stripe-donations' === $hook ) {
    wp_enqueue_script( 'ace', 'https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.0/ace.js' );
    wp_enqueue_script( 'runway_admin_settings', plugins_url( '/js/admin-settings.js', __FILE__ ), array('jquery'), $runway_stripe_plugin_version );
  }

  if( 'settings_page_runway-stripe-donations' === $hook || 'tools_page_runway-stripe-download' === $hook ) {
    wp_enqueue_script( 'runway_ajax_script', plugins_url( '/js/admin-ajax.js', __FILE__ ), array('jquery'), $runway_stripe_plugin_version );

    wp_localize_script(
      'runway_ajax_script',
      'runway_ajax_values',
      array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'admin_email' => get_option( 'admin_email' ),
        'download_url' => plugins_url( '/do-data-export.php', __FILE__ ),
        'stripe_account' => isset($_POST['stripe_account']) ? $_POST['stripe_account'] : '' // Used on the data export page
      )
    );
  }
}

add_action( 'wp_ajax_runway_stripe_send_test_mail', 'runway_stripe_send_test_mail_callback' );
function runway_stripe_send_test_mail_callback() {

  $options = get_option('runway_stripe_options');
  $result = runway_stripe_send_test_email($_POST['email'], $_POST['api_key'], $_POST['template_id']);

  if (is_object($result) && isset($result->errors)) {
    echo "Error sending message: {$result->errors[0]->message} ({$result->errors[0]->description})";
  } else {
    echo "Success";
  }

  die();
}

add_action( 'wp_ajax_runway_stripe_send_receipt_mail', 'runway_stripe_send_receipt_mail_callback' );
function runway_stripe_send_receipt_mail_callback() {
  global $runway_stripe_plugin_version;

  require_once(__DIR__.'/vendor/autoload.php');

  $account = $_POST['stripe_account'];
  $options = get_option('runway_stripe_options');
  Stripe::setApiKey($options["account_{$account}_secret_key"]);
  Stripe::setAppInfo("runway-stripe-donations", $runway_stripe_plugin_version, "http://runway.io");

  try {
    // Fetch the charge.
    $charge = Charge::retrieve($_POST['charge_id']);
    $result = runway_stripe_send_receipt_email($charge, $account, $options, false);

    if (is_object($result) && $result->status === 'error') {
      echo "Error: {$result->message}";
    } else {
      echo 'Sent';
    }

  } catch (Base $e) {
    $err = $e->getJsonBody();
    echo('Stripe error from sending receipt in admin area ('.$err['error']['type'].'): ' . $err['error']['message']);
  } catch (Exception $e) {
    echo('Exception from sending receipt in admin area: ' . $e);
  }

  die();
}

add_action( 'wp_ajax_runway_stripe_get_log_entries', 'runway_stripe_get_log_entries_callback' );
function runway_stripe_get_log_entries_callback() {

  global $wpdb;

  $log_entries = $wpdb->get_results(
    $wpdb->prepare(
      "SELECT * FROM {$wpdb->prefix}runway_stripe_log WHERE id > %d ORDER BY id DESC LIMIT 500;",
      array($_GET['lastLogEntry'])
    )
  );
  echo json_encode($log_entries);

  die();
}
