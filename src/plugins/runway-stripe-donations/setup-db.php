<?php

function runway_stripe_setup_db() {
  // See http://codex.wordpress.org/Creating_Tables_with_Plugins for details of the restrictions on the SQL here.
  global $wpdb;

  $prefix = $wpdb->prefix;

  /*
   * We'll set the default character set and collation for this table.
   * If we don't do this, some characters could end up being converted
   * to just ?'s when saved in our table.
   */
  $charset_collate = '';

  if ( ! empty( $wpdb->charset ) ) {
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
  }

  if ( ! empty( $wpdb->collate ) ) {
    $charset_collate .= " COLLATE {$wpdb->collate}";
  }

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

  // fund is a legacy column, it can be removed after data has been migrated out of it.

  $sql = "CREATE TABLE {$prefix}runway_stripe_data (
    id INT NOT NULL AUTO_INCREMENT,
    account_id INT NOT NULL,
    charge_id VARCHAR(100) NOT NULL,
    created_dt DATETIME NOT NULL,
    amount NUMERIC(15,2) NOT NULL,
    stripe_fee NUMERIC(15,2) NOT NULL,
    net_amount NUMERIC(15,2) NOT NULL,
    currency VARCHAR(3) NOT NULL,
    successful BOOLEAN,
    recurring BOOLEAN,
    fund VARCHAR(200),
    campaign VARCHAR(200),
    event VARCHAR(200),
    stripe_customer_id VARCHAR(100) NOT NULL,
    email_address VARCHAR(200),
    name VARCHAR(200),
    receipt_email_sent BOOLEAN,
    receipt_email_sent_dt DATETIME,
    receipt_email_error VARCHAR(500),
    address_line_1 VARCHAR(200),
    address_line_2 VARCHAR(200),
    address_city VARCHAR(200),
    address_state VARCHAR(200),
    address_zip VARCHAR(15),
    address_country VARCHAR(200),
    phone_number VARCHAR(100),
    email_opt_out BOOLEAN,
    first_name VARCHAR(200),
    last_name VARCHAR(200),
    tax_id VARCHAR(50),
    gift_aid BOOLEAN,
    custom_1 VARCHAR(200),
    custom_2 VARCHAR(200),
    custom_3 VARCHAR(200),
    balance_transaction_id VARCHAR(100) NOT NULL,
    transfer_id VARCHAR(100) NOT NULL,
    transfer_dt DATETIME NOT NULL,
    salesforce_contact_id VARCHAR(100) NULL,
    salesforce_donation_id VARCHAR(100) NULL,
    salesforce_sync_error VARCHAR(1000) NULL,
    PRIMARY KEY  (id),
    UNIQUE KEY balance_transaction_id (balance_transaction_id)
  ) $charset_collate;";

  dbDelta($sql);

  $sql = "CREATE TABLE {$prefix}runway_stripe_transfers (
    id INT NOT NULL AUTO_INCREMENT,
    transfer_id VARCHAR(100) NOT NULL,
    transfer_dt DATETIME NOT NULL,
    PRIMARY KEY  (id),
    UNIQUE KEY transfer_id (transfer_id)
  ) $charset_collate;";

  dbDelta($sql);

  $sql = "CREATE TABLE {$prefix}runway_stripe_log (
    id INT NOT NULL AUTO_INCREMENT,
    created_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_error BOOLEAN,
    message VARCHAR(1000),
    stack_trace TEXT,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  dbDelta($sql);

  $sql = "CREATE TABLE {$prefix}runway_stripe_salesforce_errors (
    id INT NOT NULL AUTO_INCREMENT,
    error VARCHAR(1000) NOT NULL,
    is_failure BOOLEAN,
    created_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  dbDelta($sql);

  $sql = "CREATE TABLE {$prefix}runway_stripe_salesforce_error_donation_link (
    id INT NOT NULL AUTO_INCREMENT,
    error_id INT NOT NULL,
    donation_id INT NOT NULL,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  dbDelta($sql);

  $sql = "CREATE TABLE {$prefix}runway_stripe_salesforce_campaigns (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(1000),
    salesforce_id VARCHAR(100),
    PRIMARY KEY  (id),
    UNIQUE KEY salesforce_id (salesforce_id)
  ) $charset_collate;";

  dbDelta($sql);

  $sql = "CREATE TABLE {$prefix}runway_stripe_honeypot_log (
    id INT NOT NULL AUTO_INCREMENT,
    created_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    account_id INT NOT NULL,
    amount NUMERIC(15,2) NOT NULL,
    currency VARCHAR(3) NOT NULL,
    ip_address VARCHAR(45),
    request_values TEXT,
    PRIMARY KEY  (id)
  ) $charset_collate;";

  dbDelta($sql);
}
