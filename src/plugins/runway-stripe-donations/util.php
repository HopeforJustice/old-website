<?php

// Note: this file is only loaded by standalone pages.

$runway_stripe_date_format = 'Y-m-d H:i:s'; // Must match the value in runway-stripe-donations.php
$runway_stripe_available_currencies = array( // Must match the value in runway-stripe-donations.php
  'EUR',
  'GBP',
  'NOK',
  'USD',
  'ZAR'
);

$runway_stripe_metadata_text_fields = array(
  'campaign',
  'fund', // Legacy field, needed as some old subscriptions might still have it.
  'phone_number',
  'first_name',
  'last_name',
  'tax_id',
  'custom_1',
  'custom_2',
  'custom_3'
);

$runway_stripe_metadata_boolean_fields = array(
  'email_opt_out',
  'gift_aid'
);

function runway_stripe_load_wordpress_core() {
  if(file_exists($_SERVER['DOCUMENT_ROOT'].'/core/wp-load.php')) {
    require_once($_SERVER['DOCUMENT_ROOT'].'/core/wp-load.php');
  } else {
    require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
  }
}

if (!function_exists('write_log')) {
  function write_log ( $log )  {
    if (true === WP_DEBUG) {
      if (is_array( $log ) || is_object($log)) {
        error_log( print_r( $log, true ) );
      } else {
        error_log( $log );
      }
    }
  }
}
