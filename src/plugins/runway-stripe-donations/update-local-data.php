<?php

defined('ABSPATH') or die("No script kiddies please!");

use Stripe\BalanceTransaction;
use Stripe\Stripe;
use Stripe\Transfer;
use Stripe\Error\Base;

function runway_stripe_configure_cron() {
  $existing_schedule = wp_get_schedule('runway_stripe_data_update_hook');
  if($existing_schedule !== 'hourly') {
    wp_schedule_event(time(), 'hourly', 'runway_stripe_data_update_hook');
  }

  $existing_schedule = wp_get_schedule('runway_stripe_salesforce_sync_hook');
  if($existing_schedule !== 'hourly') {
    wp_schedule_event(time(), 'hourly', 'runway_stripe_salesforce_sync_hook');
  }
}

function runway_stripe_uninstall_cron() {
  wp_clear_scheduled_hook('runway_stripe_daily_event_hook'); // From a previous version of the plugin
  wp_clear_scheduled_hook('runway_stripe_data_update_hook');
}

add_action('runway_stripe_data_update_hook', 'runway_stripe_do_data_update');
function runway_stripe_do_data_update() {
  global $runway_stripe_account_count;

  $options = get_option('runway_stripe_options');

  for($account = 1; $account <= $runway_stripe_account_count; $account++) {
    try {
      runway_stripe_fetch_data_for_account($account, $options);

    } catch (Base $ex) {
      runway_stripe_record_error('Stripe data error: '.$ex->getMessage(), $ex->getTraceAsString(), 'Stripe');
    } catch (Exception $ex) {
      runway_stripe_record_error($ex->getMessage(), $ex->getTraceAsString(), 'Stripe');
    }
  }
}

function runway_stripe_save_transaction($transaction, $transfer, $account) {
  global $wpdb;
  global $runway_stripe_date_format;

  $charge = $transaction->source;

  if(!$charge->customer->id) {
    throw new Exception("Charge {$charge->id} does not have a customer ID associated with it.");
  }

  $wpdb->insert(
    $wpdb->prefix.'runway_stripe_data',
    array(
      'account_id' => $account,
      'charge_id' => $charge->id,
      'created_dt' => date($runway_stripe_date_format, $transaction->created),
      'amount' => round($transaction->amount/100, 2),
      'stripe_fee' => round($transaction->fee/100, 2),
      'net_amount' => round($transaction->net/100, 2),
      'currency' => strtoupper($transaction->currency),
      'successful' => $charge->paid,
      'recurring' => isset($charge->invoice),
      'campaign' => $charge->metadata['campaign'] ? $charge->metadata['campaign'] : $charge->metadata['fund'], // If no campaign then fall back to 'fund', a legacy field that might still exist on some subscriptions.
      'event' => $charge->metadata['event'],
      'stripe_customer_id' => $charge->customer->id,
      'email_address' => $charge->customer->email,
      'name' => $charge->card->name,
      'receipt_email_sent' => $charge->metadata['receipt_email_sent'] === 'true',
      'receipt_email_sent_dt' => isset($charge->metadata['receipt_email_sent_dt']) ? date($runway_stripe_date_format, $charge->metadata['receipt_email_sent_dt']) : null,
      'receipt_email_error' => $charge->metadata['receipt_email_error'],
      'address_line_1' => $charge->card->address_line1,
      'address_line_2' => $charge->card->address_line2,
      'address_city' => $charge->card->address_city,
      'address_state' => $charge->card->address_state,
      'address_zip' => $charge->card->address_zip,
      'address_country' => $charge->card->address_country,
      'phone_number' => $charge->metadata['phone_number'],
      'email_opt_out' => $charge->metadata['email_opt_out'] === 'true',
      'first_name' => $charge->metadata['first_name'],
      'last_name' => $charge->metadata['last_name'],
      'tax_id' => $charge->metadata['tax_id'],
      'gift_aid' => $charge->metadata['gift_aid'] === 'true',
      'custom_1' => $charge->metadata['custom_1'],
      'custom_2' => $charge->metadata['custom_2'],
      'custom_3' => $charge->metadata['custom_3'],
      'balance_transaction_id' => $transaction->id,
      'transfer_id' => $transfer->id,
      'transfer_dt' => date($runway_stripe_date_format, $transfer->date)
    )
  );

  if($wpdb->last_error) throw new Exception('SQL Error: '.$wpdb->last_error);
}

function runway_stripe_transfer_already_processed($transfer) {
  global $wpdb;
  $transfer_count = $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM {$wpdb->prefix}runway_stripe_transfers WHERE transfer_id = %s",
    $transfer->id
  ));
  return $transfer_count > 0;
}

function runway_stripe_transaction_already_processed($transaction) {
  global $wpdb;
  $transaction_count = $wpdb->get_var($wpdb->prepare(
    "SELECT COUNT(*) FROM {$wpdb->prefix}runway_stripe_data WHERE balance_transaction_id = %s",
    $transaction->id
  ));
  return $transaction_count > 0;
}

function runway_stripe_get_transaction_iterator($transferId, $type) {
  $transactions = BalanceTransaction::all(array(
    'transfer' => $transferId,
    'type' => $type,
    'expand' => array('data.source', 'data.source.invoice', 'data.source.customer')
  ));

  return $transactions->autoPagingIterator();
}

function runway_stripe_fetch_transactions($account) {
  global $wpdb;
  global $runway_stripe_date_format;

  $transfers = Transfer::all(array( 'status' => 'paid' ));

  foreach ($transfers->autoPagingIterator() as $transfer) {
    if(!runway_stripe_transfer_already_processed($transfer)) {

      $iterator = new AppendIterator;
      $iterator->append(runway_stripe_get_transaction_iterator($transfer->id, 'charge'));
      $iterator->append(runway_stripe_get_transaction_iterator($transfer->id, 'refund'));

      $transactions_processed = 0;

      foreach ($iterator as $transaction) {
        // It's possible that we only got half way through processing this transaction, so we need to make
        // sure we don't insert duplicate lines.
        if(!runway_stripe_transaction_already_processed($transaction)
              && !empty($transaction->source->customer->id)) { // Charges without customers must have come from elsewhere.
          runway_stripe_save_transaction($transaction, $transfer, $account);
          $transactions_processed++;
        }
      }

      // Record that we've finished downloading this transfer
      runway_stripe_record_message($transactions_processed.' transactions processed for transfer '.$transfer->id, 'Stripe');
      $wpdb->insert(
        $wpdb->prefix.'runway_stripe_transfers',
        array(
          'transfer_id' => $transfer->id,
          'transfer_dt' => date($runway_stripe_date_format, $transfer->date)
        )
      );
    }
  }

  runway_stripe_record_message("Stripe sync complete (Account $account)", 'Stripe');
}

function runway_stripe_fetch_data_for_account($account, $options) {
  global $wpdb;
  global $runway_stripe_plugin_version;
  require_once(__DIR__.'/vendor/autoload.php');

  runway_stripe_record_message("Looking for new transfers in Stripe (Account $account)", 'Stripe');

  Stripe::setApiKey($options["account_{$account}_secret_key"]);
  Stripe::setAppInfo("runway-stripe-donations", $runway_stripe_plugin_version, "http://runway.io");

  runway_stripe_fetch_transactions($account);
}
