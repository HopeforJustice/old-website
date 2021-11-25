<?php
/**
 * Plugin Name: Runway Stripe Donations
 * Plugin URI: http://www.runway.io
 * Description: Allows taking either one-off or recurring donations using Stripe. Supports multiple Stripe accounts. Also sends donation data to Salesforce.
 * Version: 0.16.4
 * Author: Runway
 * Author URI: http://www.runway.io
 */

defined('ABSPATH') or die("No script kiddies please!");

$runway_stripe_plugin_version = '0.16.4';

$runway_stripe_account_count = 3;
$runway_stripe_shortcode_setting_prefix = 'donate_';
$runway_stripe_date_format = 'Y-m-d H:i:s'; // Must match the value in util.php
$runway_stripe_available_currencies = array( // Must match the value in util.php
  'EUR',
  'GBP',
  'NOK',
  'USD',
  'ZAR'
);

include('admin-settings.php');
include('admin-tools.php');
include('admin-ajax-functions.php');
include('data-export.php');
include('shortcodes/runway-stripe-donation-count.php');
include('shortcodes/runway-stripe-donations.php');
include('email-sending.php');
include('roles-and-capabilities.php');

include('setup-db.php');
include('update-local-data.php');
include('salesforce-sync.php');

require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
  'http://upword.runway.io/api/1/plugins/2/update_check',
  __FILE__,
  'runway-stripe-donations'
);

register_activation_hook(__FILE__, 'runway_stripe_install_roles');
register_deactivation_hook(__FILE__, 'runway_stripe_uninstall_cron');
register_deactivation_hook(__FILE__, 'runway_stripe_uninstall_roles');
register_deactivation_hook(__FILE__, 'runway_stripe_remove_stored_version');

// Try and detect whether the plugin has been updated
if(is_admin()) {
  add_action('plugins_loaded', 'runway_stripe_check_for_updates');

  function runway_stripe_check_for_updates() {
    global $runway_stripe_plugin_version;

    $stored_version = get_option('runway_stripe_version');
    if($stored_version !== $runway_stripe_plugin_version) {
      runway_stripe_plugin_updated();
      update_option('runway_stripe_version', $runway_stripe_plugin_version);
    }
  }

  function runway_stripe_plugin_updated() {
    runway_stripe_setup_db();
    runway_stripe_configure_cron();
  }
}

function runway_stripe_remove_stored_version() {
  delete_option('runway_stripe_version');
}

function runway_stripe_record_error($message, $stack_trace = '', $area = '') {
  global $wpdb;
  if($area) {
    $message = "[$area] $message";
  }
  $wpdb->insert(
    $wpdb->prefix.'runway_stripe_log',
    array(
      'is_error' => true,
      'message' => substr($message, 0, 1000),
      'stack_trace' => $stack_trace
    )
  );
}

function runway_stripe_record_message($message, $area = '') {
  global $wpdb;
  if($area) {
    $message = "[$area] $message";
  }
  $wpdb->insert(
    $wpdb->prefix.'runway_stripe_log',
    array(
      'is_error' => false,
      'message' => substr($message, 0, 1000)
    )
  );
}
