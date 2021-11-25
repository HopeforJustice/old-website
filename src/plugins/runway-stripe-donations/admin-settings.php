<?php

defined('ABSPATH') or die("No script kiddies please!");

add_action( 'admin_menu', array( 'RunwayStripeSettings', 'add_menu_items' ) );
add_action( 'admin_init', array( 'RunwayStripeSettings', 'initialise_settings' ) );

class RunwayStripeSettings {

  private static $stripe_account_settings = array(
    'name' => array( 'label' => 'Account name' ),
    'secret_key' => array( 'label' => 'Secret API Key' ),
    'publishable_key' => array( 'label' => 'Publishable API Key' ),
    'sparkpost_template_id' => array( 'label' => 'SparkPost template ID', 'help_text' => 'If this is not set then the default value on the SparkPost tab will be used.' ),
    'currency' => array( 'label' => 'Default currency' ),
    'form_template' => array( 'label' => 'Form template' )
  );

  public static function add_menu_items() {
    add_options_page( 'Runway Stripe Donations Options', 'Stripe Donations', 'manage_options', 'runway-stripe-donations', array('RunwayStripeSettings', 'render_page') );
  }

  public static function initialise_settings() {
    global $runway_stripe_account_count;

    register_setting('runway_stripe_options', 'runway_stripe_options', array('RunwayStripeSettings', 'validate_options') );

    add_settings_section('runway_stripe_general', 'General', array('RunwayStripeSettings', 'render_section_text'), 'runway_stripe');
    self::add_text_settings_field('thank_you_url', 'Thank you page URL', 'general');
    self::add_text_settings_field('image_url', 'Image URL (for the Checkout popup)', 'general');

    add_settings_section('runway_stripe_sparkpost', 'SparkPost', array('RunwayStripeSettings', 'render_section_text'), 'runway_stripe');
    self::add_text_settings_field('sparkpost_api_key', 'SparkPost API key', 'sparkpost');
    self::add_text_settings_field('sparkpost_template_id', 'SparkPost template ID (default)', 'sparkpost');

    for($account = 1; $account <= $runway_stripe_account_count; $account++) {
      add_settings_section("runway_stripe_account_{$account}", "Stripe account {$account}", array('RunwayStripeSettings', 'render_section_text'), "runway_stripe", array('account' => $account));
      foreach (self::$stripe_account_settings as $key => $details) {
        self::add_account_settings_field($key, $account, $details);
      }
    }

    add_settings_section('runway_stripe_salesforce', 'Salesforce', array('RunwayStripeSettings', 'render_section_text'), 'runway_stripe');
    self::add_generic_settings_field('salesforce_stripe_account', 'Stripe account', 'salesforce', 'render_select_account_option', array('key' => 'salesforce_stripe_account'));
    self::add_text_settings_field('salesforce_email', 'Salesforce account email', 'salesforce');
    self::add_text_settings_field('salesforce_password', 'Salesforce account password', 'salesforce', 'password');
    self::add_text_settings_field('salesforce_security_token', 'Salesforce security token', 'salesforce');
    self::add_boolean_settings_field('salesforce_sandbox', 'Use sandbox', 'salesforce');
    self::add_text_settings_field('salesforce_after_date', 'Import donations after date', 'salesforce', 'date');
    self::add_text_settings_field('salesforce_error_email', 'Email address for error notifications', 'salesforce');

    add_settings_section('runway_stripe_form_templates', 'Form Templates', array('RunwayStripeSettings', 'render_section_text'), 'runway_stripe');
    self::add_text_settings_field('form_templates', 'Form Templates', 'form_templates', 'hidden');
  }

  private static function add_text_settings_field($key, $label, $section, $type = 'text') {
    self::add_generic_settings_field($key, $label, $section, 'render_text_option_from_args', array('key' => $key, 'type' => $type));
  }

  private static function add_boolean_settings_field($key, $label, $section) {
    self::add_generic_settings_field($key, $label, $section, 'render_boolean_option_from_args', array('key' => $key));
  }

  private static function add_account_settings_field($key, $account, $details) {
    $help_text = isset($details['help_text']) ? $details['help_text'] : '';
    self::add_generic_settings_field("account_{$account}_{$key}", $details['label'], "account_{$account}", 'render_account_option', array('key' => $key, 'account' => $account, 'help_text' => $help_text));
  }

  private static function add_generic_settings_field($key, $label, $section, $render_function, $args) {
    add_settings_field("runway_stripe_$key", $label, array('RunwayStripeSettings', $render_function), 'runway_stripe', "runway_stripe_$section", $args);
  }

  public static function render_account_option($args) {
    switch($args['key']) {
      case 'currency':
        self::render_account_currency_option($args['account']);
        break;
      case 'form_template':
        self::render_account_form_template_option($args['account']);
        break;
      default:
        self::render_account_text_option($args['key'], $args['account'], $args['help_text']);
    }
  }

  private static function render_account_text_option($key, $account, $help_text = '') {
    self::render_text_option("account_{$account}_$key", 'text', $help_text);
  }

  private static function render_account_currency_option($account) {
    global $runway_stripe_available_currencies;

    $options = get_option('runway_stripe_options');
    $current_value = !empty($options["account_{$account}_currency"]) ? $options["account_{$account}_currency"] : 'USD';

    $currency_options = array_map(function ($c) { return array('name' => $c); }, $runway_stripe_available_currencies);

    runway_stripe_select_list("runway_stripe_options[account_{$account}_currency]", $current_value, $currency_options);
  }

  private static function render_account_form_template_option($account) {
    $options = get_option('runway_stripe_options');
    $current_value = !empty($options["account_{$account}_form_template"]) ? $options["account_{$account}_form_template"] : 'USD';

    $template_choices = array_map(
      function ($t) { return array('name' => $t->name, 'value' => $t->guid ); },
      self::form_templates()
    );
    array_unshift($template_choices, array( 'name' => 'None (use Stripe Checkout)', 'value' => ''));

    runway_stripe_select_list("runway_stripe_options[account_{$account}_form_template]", $current_value, $template_choices);
  }

  public static function render_select_account_option($args) {
    global $runway_stripe_account_count;

    $key = $args['key'];

    $options = get_option('runway_stripe_options');
    $current_value = !empty($options[$key]) ? $options[$key] : '1';

    $account_details = array();
    for($account = 1; $account <= $runway_stripe_account_count; $account++) {
      $account_details[$account] = array(
        'value' => $account,
        'name' => runway_stripe_account_name($account, $options)
      );
    }

    runway_stripe_select_list("runway_stripe_options[{$key}]", $current_value, $account_details);
  }

  private static function render_text_option($key, $type = 'text', $help_text = '') {
    echo "<input id=\"runway_stripe_$key\" name=\"runway_stripe_options[$key]\" size=\"40\" type=\"$type\" value=\"".esc_attr(self::option_or_blank($key))."\" />";
    if($help_text) {
      echo '<p>'.esc_html($help_text).'</p>';
    }
  }

  public static function render_text_option_from_args($args) {
    $type = isset($args['type']) ? $args['type'] : null;
    self::render_text_option($args['key'], $type);
  }

  public static function render_boolean_option_from_args($args) {
    $key = $args['key'];
    $options = get_option('runway_stripe_options');
    $checked = !empty($options[$key]) ? 'checked="checked"' : '';

    echo "<input id=\"runway_stripe_$key\" name=\"runway_stripe_options[$key]\" type=\"checkbox\" $checked />";
  }

  private static function option_or_blank($key) {
    $options = get_option('runway_stripe_options');
    return isset($options[$key]) ? $options[$key] : '';
  }

  public static function render_section_text($args) {
    if(strpos($args['id'], 'runway_stripe_account_') === 0) {
      ?>
      <div class="section-text"><a href="?page=runway-stripe-donations&amp;tab=documentation#shortcodes">Learn about webhooks and available shortcodes</a></div>
      <?php
    } else {
      switch($args['id']) {
        case 'runway_stripe_general':
          // No text
          break;
        case 'runway_stripe_sparkpost':
          ?>
          <p><a href="?page=runway-stripe-donations&amp;tab=documentation#sparkpost-merge-codes">Learn about available merge codes</a></p>
          <p>
            <input type="button" class="button" value="Send test email" id="runway_stripe_send_test_email" />
            <span></span>
          </p>
          <?php
          break;
        case 'runway_stripe_salesforce':
          ?>
          <div class="section-text">To get a security token from Salesforce click on your name at the top and select My Settings -&gt; Personal (tab on the left) -&gt; Reset My Security Token and click <i>Reset Security Token</i>.</div>
          <?php
          break;
      }
    }

  }

  public static function validate_options($input) {
    global $runway_stripe_account_count;

    // Load the existing settings so that we don't overwrite the values of
    // settings on other tabs.
    $settings = get_option('runway_stripe_options');

    switch ($input['tab']) {
      case 'stripe':
        $settings['thank_you_url'] = $input['thank_you_url'];
        $settings['image_url'] = $input['image_url'];

        for($account = 1; $account <= $runway_stripe_account_count; $account++) {
          foreach (self::$stripe_account_settings as $key => $details) {
            $settings["account_{$account}_{$key}"] = $input["account_{$account}_{$key}"];
          }
        }
        break;

      case 'sparkpost':
        $settings['sparkpost_api_key'] = $input['sparkpost_api_key'];
        $settings['sparkpost_template_id'] = $input['sparkpost_template_id'];
        break;

      case 'salesforce':
        $settings['salesforce_stripe_account'] = $input['salesforce_stripe_account'];
        $settings['salesforce_email'] = $input['salesforce_email'];
        $settings['salesforce_password'] = $input['salesforce_password'];
        $settings['salesforce_security_token'] = $input['salesforce_security_token'];
        $settings['salesforce_sandbox'] = isset($input['salesforce_sandbox']);
        $settings['salesforce_after_date'] = $input['salesforce_after_date'];
        $settings['salesforce_error_email'] = $input['salesforce_error_email'];
        break;

      case 'form_templates':
        $settings['form_templates'] = $input['form_templates'];
        break;

    }

    return $settings;
  }

  private static function render_tabs($current_tab) {
    $tabs = array(
      'stripe' => 'Stripe',
      'sparkpost' => 'SparkPost',
      'salesforce' => 'Salesforce',
      'form_templates' => 'Form Templates',
      'documentation' => 'Documentation',
      'logs' => 'Logs',
      'honeypot_hits' => 'Honeypot Hits'
    );
    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
      $class = ( $tab == $current_tab ) ? ' nav-tab-active' : '';
      echo "<a class='nav-tab$class' href='?page=runway-stripe-donations&tab=$tab'>$name</a>";
    }
    echo '</h2>';
  }

  // Adapted from the WordPress source for do_settings_sections
  private static function do_settings_section( $page, $section_id ) {
    global $wp_settings_sections, $wp_settings_fields;

    if ( ! isset( $wp_settings_sections[$page] ) ) return;

    $section = $wp_settings_sections[$page][$section_id];

    if ( $section['title'] )
      echo "<h3>{$section['title']}</h3>\n";

    if ( $section['callback'] )
      call_user_func( $section['callback'], $section );

    if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
       return;
    echo '<table class="form-table">';
    do_settings_fields( $page, $section['id'] );
    echo '</table>';

  }

  public static function render_page() {
    if ( !current_user_can( 'manage_options' ) )  {
      wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    $current_tab = isset($_GET['tab']) ? $_GET['tab'] : 'stripe';
    ?>
    <style type="text/css">
      .form-table + h3 {
        border-top: 1px solid #ddd;
        margin-top: 0;
        padding-top: 1em;
      }

      th, td {
        font-size: 13px;
        vertical-align: top;
        padding-bottom: 6px;
      }

      .log-table th {
        white-space: nowrap;
        padding-right: 10px;
      }

      .log-table__row--error {
        color: red;
      }

      tr + .template__name {
        border-top: 1px solid #ddd;
      }

      .template__body textarea,
      .template__body .ace_editor {
        min-width: 80%;
        min-height: 250px;
      }

      .template__remove {
        color: #a00;
        text-decoration: none;
      }

      .template__remove:hover {
        color: red;
      }

      .runway-stripe-hidden-details-toggle {
        margin-left: 15px;
      }

      .runway-stripe-hidden-details-toggle:hover {
        cursor: pointer;
      }
    </style>
    <div class="wrap">
      <h2><?php _e('Runway Stripe Donations Options'); ?></h2>
      <?php self::render_tabs($current_tab); ?>

      <form method="POST" action="options.php">
        <input type="hidden" name="runway_stripe_options[tab]" value="<?php echo $current_tab; ?>" />
        <?php self::render_tab_contents($current_tab) ?>
      </form>

    </div>
    <?php
  }

  private static function render_tab_contents($current_tab) {
    switch ($current_tab) {
      case 'stripe':
        self::render_stripe_tab_contents();
        break;
      case 'sparkpost':
        self::render_sparkpost_tab_contents();
        break;
      case 'salesforce':
        self::render_salesforce_tab_contents();
        break;
      case 'form_templates':
        self::render_form_templates_tab_contents();
        break;
      case 'logs':
        self::render_logs_tab_contents();
        break;
      case 'honeypot_hits':
        self::render_honeypot_hits_tab_contents();
        break;
      case 'documentation':
        self::render_documentation_tab_contents();
        break;
    }
  }

  private static function render_stripe_tab_contents() {
    global $runway_stripe_account_count;

    settings_fields('runway_stripe_options');
    self::do_settings_section('runway_stripe', 'runway_stripe_general');

    for($account = 1; $account <= $runway_stripe_account_count; $account++) {
      self::do_settings_section('runway_stripe', "runway_stripe_account_{$account}");
    }
    ?>

    <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
    <?php
  }

  private static function render_sparkpost_tab_contents() {
    settings_fields('runway_stripe_options');
    self::do_settings_section('runway_stripe', 'runway_stripe_sparkpost');
    ?>

    <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
    <?php
  }

  private static function render_salesforce_tab_contents() {
    settings_fields('runway_stripe_options');
    self::do_settings_section('runway_stripe', 'runway_stripe_salesforce');
    ?>

    <input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
    <?php
  }

  private static function render_form_templates_tab_contents() {
    settings_fields('runway_stripe_options');
    self::render_text_option('form_templates', 'hidden');
    ?>
    <h3>
      Form Templates
      <a id="add-template" href="javascript:void(0);" class="add-new-h2">Add New</a>
    </h3>

    <table id="form-templates" class="form-table">
    </table>
    <p id="no-templates">
      There are no form templates defined.
    </p>

    <div style="margin-top: 20px;">
      <input name="Submit" id="submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
    </div>
    <?php
  }

  private static function render_logs_tab_contents() {
    global $wpdb;

    $wpdb->show_errors();
    $log_entries = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}runway_stripe_log ORDER BY id DESC LIMIT 500;");

    ?>
    <script>var lastLogEntry = <?php echo $log_entries[0]->id; ?>;</script>
    <p>
      <i>This page will automatically update with new log entries.</i>
    </p>
    <table id="runway-stripe-log-table" class="log-table">
      <?php foreach ($log_entries as $entry) { ?>
        <tr <?php echo $entry->is_error ? 'class="log-table__row--error"' : ''; ?>>
          <th><?php echo $entry->created_dt; ?></th>
          <td><?php echo $entry->message; ?></td>
        </tr>
      <?php } ?>
    </table>
    <?php
  }

  private static function render_honeypot_hits_tab_contents() {
    global $wpdb;
    $options = get_option('runway_stripe_options');

    $wpdb->show_errors();
    $log_entries = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}runway_stripe_honeypot_log ORDER BY id DESC LIMIT 500;");

    ?>
    <table class="log-table" style="padding-top: 20px;">
      <?php foreach ($log_entries as $entry) { ?>
        <tr>
          <th><?php echo $entry->created_dt; ?></th>
          <td>
            [<?php echo $entry->ip_address; ?>]
            Account: <?php echo runway_stripe_account_name($entry->account_id, $options); ?>,
            <?php echo runway_stripe_format_currency($entry->amount, $entry->currency); ?>

            <a class="runway-stripe-hidden-details-toggle">
              Show details
            </a>

            <div class="runway-stripe-hidden-details" style="display: none;">
              <pre><?php
                echo json_encode(json_decode($entry->request_values), JSON_PRETTY_PRINT);
              ?></pre>
            </div>
          </td>
        </tr>
      <?php } ?>
    </table>
    <?php
  }

  private static function render_documentation_tab_contents() {
    global $runway_stripe_account_count;
    global $runway_stripe_shortcode_setting_prefix;
    global $runway_stripe_available_currencies;
    $options = get_option('runway_stripe_options');
    ?>

    <h3 id="shortcodes">Shortcodes</h3>
    <h4>runway-stripe-donations</h4>
    <p>
      The <code>runway-stripe-donations</code> shortcode must include the account number.
      For example: <code>[runway-stripe-donations account="1"]</code>.
    </p>
    <pre><?php
      for($account = 1; $account <= $runway_stripe_account_count; $account++) {
        echo runway_stripe_account_name($account, $options).": [runway-stripe-donations account=\"$account\"]";
        echo "\n";
      }
    ?></pre>
    <p>There are a number of optional parameters that may also be used:</p>
    <table>
      <tr>
        <td>
          <code>campaign</code>
        </td>
        <td>
          These are stored in Stripe metadata and made available in data exports.
          For example: <code>[runway-stripe-donations account="1" campaign="January 2015 dinner"]</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>amount_regular</code>
          <code>amount_one_off</code>
        </td>
        <td>
          These can be used to override the default donation amount (usually 30).
          For example: <code>[runway-stripe-donations account="1" amount_one_off="35"]</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>currency</code>
        </td>
        <td>
          Override the account's default currency.
          This should be given as the three letter currency code.
          Currently the allowed values are: <?php echo implode(', ', array_map(function ($c) { return "<code>$c</code>";}, $runway_stripe_available_currencies)); ?>.
        </td>
      </tr>
      <tr>
        <td>
          <code>use_tabs</code>
        </td>
        <td>
          Whether or not this form sits within tabs that allow users to pick between monthly and one-off donations.
          Possible values are <code>true</code> and <code>false</code>.
          The default is <code>false</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>form_layout</code>
        </td>
        <td>
          On the default template these classes are added to <code>donation-form </code> to provide alternate layouts for the donation form.
          Current support values are default (no value set), and 'simple'.
        </td>
      </tr>
      <tr>
        <td>
          <code>button_text</code>
        </td>
        <td>
          On the default template this is the text used on the button that opens the Checkout popup.
          The default text is "Donate".
        </td>
      </tr>
      <tr>
        <td>
          <code>button_class</code>
        </td>
        <td>
          On the default template these classes are added to <code>donation-form__button button</code> to make the class of the button.
          The default value is <code>button--orange button--solid button--large</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>thank_you_url</code>
        </td>
        <td>
          Override the default thank you URL.
          The user will be taken to this page after making their donation.
        </td>
      </tr>
    </table>
    <p>
      With the default template if <code>use_tabs</code> isn't set to <code>true</code> then the type of donation will be set by whether <code>amount_regular</code> is present.
      If it's there (and not zero) then the donation will be monthly. Without this it will be a one-off.
    </p>
    <p>
      These options can also be used on the query string, but they must be prefixed with <code><?php echo $runway_stripe_shortcode_setting_prefix; ?></code>.
      For example: <code>/donate/uk?<?php echo $runway_stripe_shortcode_setting_prefix; ?>amount_regular=35&amp;<?php echo $runway_stripe_shortcode_setting_prefix; ?>campaign=Dare%20to%20be</code>.
      The values from the query string will take precendence over those in shortcodes.
    </p>

    <h4>runway-stripe-donation-count</h4>
    <p>
      The <code>runway-stripe-donation-count</code> shortcode outputs the number of donations that have been recorded.
      When the <code>campaign</code> parameter is specified the count is of all donation linked to that campaign.
      When there is no <code>campaign</code> it outputs the count of all donations that aren't linked to a campaign.
    </p>
    <p>
      e.g. <code>[runway-stripe-donation-count campaign="Dare to be"]</code>
    </p>

    <h3>Stripe Webhooks</h3>
    <p>
      For receipt emails to be sent the instant a payment is taken a webhook URL must be added to each Stripe account.
      This allows Stripe to notify us when charges have been successful.
      Until this has been set you will need to press the button next to each charge on the <a href="tools.php?page=runway-stripe-download">Donation Data</a> page.
    </p>
    <p>
      This webhook URL can be set in the <a href="https://dashboard.stripe.com/account/webhooks" target="_blank">account setting popup in the Stripe dashboard</a>.
      Be careful as the URL is slightly different for each account.
    <pre><?php
      for($account = 1; $account <= $runway_stripe_account_count; $account++) {
        echo runway_stripe_account_name($account, $options).': '.plugins_url('stripe-webhooks.php', __FILE__).'?account='. $account;
        echo "\n";
      }
    ?></pre>

    <h3 id="sparkpost-merge-codes">SparkPost Merge Codes</h3>
    <p>
      The following merge codes are available for receipt emails sent through SparkPost.
      SparkPost uses the Handlebars template syntaxt and you can find more details <a href="https://developers.sparkpost.com/api/#/introduction/substitutions-reference/substitutions-syntax-examples" target="_blank">on their website</a>.
    </p>
    <table>
      <tr>
        <td>
          <code>account_id</code>
        </td>
        <td>
          The ID of the Stripe account, e.g. <code>1</code> for &ldquo;<?php echo runway_stripe_account_name(1, $options); ?>&rdquo;.
        </td>
      </tr>
      <tr>
        <td>
          <code>name</code>
        </td>
        <td>
          The giver's full name, as given to Stripe.
        </td>
      </tr>
      <tr>
        <td>
          <code>email</code>
        </td>
        <td>
          The giver's email address.
        </td>
      </tr>
      <tr>
        <td>
          <code>card_last_4</code>
        </td>
        <td>
          The last 4 digits of the giver's card number.
        </td>
      </tr>
      <tr>
        <td>
          <code>amount</code>
        </td>
        <td>
          The amount donated, e.g. <code>$12.34</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>date</code>
        </td>
        <td>
          The date of the donation.
          This will be formatted differently depending on the currency you have selected for the Stripe account, e.g. <code>20/12/2014</code> for GBP and <code>12/20/2014</code> for USD.
        </td>
      </tr>
      <tr>
        <td>
          <code>recurring</code>
        </td>
        <td>
          Whether this is part of a recurring donation.
          Note: a receipt email will be sent every time payment is taken for a recurring donation.
          The possible values are <code>Yes</code> and <code>No</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>campaign</code>
        </td>
        <td>
          The campaign that was specified on the shortcode used for this donation.
          This will not be included if no campaign was specified on the shortcode.
        </td>
      </tr>
    </table>

    <h3 id="form-templates">Form Templates</h3>
    <p>
      Custom forms templates are used for setting up your own forms to interface with Stripe.js.
      See the <a href="https://stripe.com/docs/tutorials/forms">Stripe.js documentation</a> for details of setting up the form and communicating with Stripe.
      There's no need to load the Stripe.js file, as this is done automatically for you.
    </p>
    <p>
      The template should contain a form with all the fields needed for Stripe.js, a <code>method="POST"</code> and <code>action="{{submit_url}}"</code>.
      <strong>Required fields</strong> in the POST data are <code>account</code>, <code>donation_amount</code>, <code>email</code>, <code>monthly</code> ("true" or "false"), <code>stripeToken</code>, <code>cancel_url</code> and <code>return_url</code>.
      Most of these can be provided automatically by the <code>{{{standard_fields}}}</code> template value.
      See below for details.
    </p>
    <p>
      Optional fields that can be submitted in the form are: <code>campaign</code>, <code>phone_number</code>, <code>first_name</code>, <code>last_name</code>, <code>tax_id</code>, <code>custom_1</code>, <code>custom_2</code>, <code>custom_3</code>, <code>email_opt_out</code> and <code>gift_aid</code>.
      The values for most of these can be any text, except for <code>email_opt_out</code> and <code>gift_aid</code> which are boolean and will be assumed to be false unless they're set to "true" or "on" (checked checkboxes have the value "on" when submitted).
    </p>
    <p>
      These templates are rendered using <a href="https://mustache.github.io/mustache.5.html">Mustache</a>. The following values are available:
    </p>
    <table>
      <tr>
        <td>
          <code>account</code>
        </td>
        <td>
          The ID of the Stripe account, e.g. <code>1</code> for &ldquo;<?php echo runway_stripe_account_name(1, $options); ?>&rdquo;.
        </td>
      </tr>
      <tr>
        <td>
          <code>currency</code>
        </td>
        <td>
          The currency to be used for this transaction.
        </td>
      </tr>
      <tr>
        <td>
          <code>site_name</code>
        </td>
        <td>
          The name of the current site.
        </td>
      </tr>
      <tr>
        <td>
          <code>amount_regular</code>
        </td>
        <td>
          The default value for recurring donations.
          This can take its value from a shortcode attribute or the query string.
        </td>
      </tr>
      <tr>
        <td>
          <code>amount_one_off</code>
        </td>
        <td>
          The default value for one-off donations.
          This can take its value from a shortcode attribute or the query string.
        </td>
      </tr>
      <tr>
        <td>
          <code>campaign</code>
        </td>
        <td>
          The campaign this donation will be linked to.
          This can take its value from a shortcode attribute or the query string.
        </td>
      </tr>
      <tr>
        <td>
          <code>error_message</code>
        </td>
        <td>
          Any error message passed back by the process that takes payment.
          This won't automatically contain errors from creating the token - you'll have to deal with those differently.
        </td>
      </tr>
      <tr>
        <td>
          <code>cancel_url</code>
        </td>
        <td>
          The URL that the user will be sent to if taking payment fails.
          Usually the same page as the form is shown on.
        </td>
      </tr>
      <tr>
        <td>
          <code>thank_you_url</code>
        </td>
        <td>
          The URL that the user will be sent to if taking payment is successful.
        </td>
      </tr>
      <tr>
        <td>
          <code>currency</code>
        </td>
        <td>
          Three letter code for the currency the donation is being taken in.
          Currently the allowed values are: <?php echo implode(', ', array_map(function ($c) { return "<code>$c</code>";}, $runway_stripe_available_currencies)); ?>.
        </td>
      </tr>
      <tr>
        <td>
          <code>input_css_class</code>
        </td>
        <td>
          CSS class to be applied to the amount input element.
          e.g. <code>input--pre-pound</code> or <code>input--pre-dollar</code>.
        </td>
      </tr>
      <tr>
        <td>
          <code>image_url</code>
        </td>
        <td>
          Image that's used in the checkout popup.
          You might have a use for it, you might not.
        </td>
      </tr>
      <tr>
        <td>
          <code>stripe_key</code>
        </td>
        <td>
          The publishable API key for this Stripe account.
          Pass this to <code>Stripe.setPublishableKey</code> to get started.
        </td>
      </tr>
      <tr>
        <td>
          <code>submit_url</code>
        </td>
        <td>
          The address that the form should be POSTed to.
        </td>
      </tr>
      <tr>
        <td>
          <code>form_id</code>
        </td>
        <td>
          A unique ID that can be used to identify the form on the page.
        </td>
      </tr>
      <tr>
        <td>
          <code>use_tabs</code>
        </td>
        <td>
          Passes on the value of the <code>use_tabs</code> shortcode setting.
          This is probably only useful for the default template.
        </td>
      </tr>
      <tr>
        <td>
          <code>button_text</code>
        </td>
        <td>
          Passes on the value of the <code>button_text</code> shortcode setting.
        </td>
      </tr>
      <tr>
        <td>
          <code>button_class</code>
        </td>
        <td>
          Passes on the value of the <code>button_class</code> shortcode setting.
        </td>
      </tr>
      <tr>
        <td>
          <code>amount_regular_is_default</code>
        </td>
        <td>
          Whether the <code>amount_regular</code> value is set to its default value.
          In the default template this is used to determine whether the donation is regular or one-off (it's considered a one-off if <code>amount_regular</code> is set to the default value).
        </td>
      </tr>
      <tr>
        <td>
          <code>data_as_json</code>
        </td>
        <td>
          All the above as a JSON object.
          Useful for getting at the values in your own JavaScript.
          This should use triple mustaches (i.e. <code>{{{data_as_json}}}</code>) so that it isn't escaped.
        </td>
      </tr>
      <tr>
        <td>
          <code>standard_fields</code>
        </td>
        <td>
          Adds hidden input fields for <code>account</code>, <code>campaign</code>, <code>cancel_url</code> and <code>return_url</code>.
          This just leaves <code>donation_amount</code>, <code>email</code>, <code>monthly</code> and <code>stripeToken</code> from the required fields.
          This should be placed inside the form tag and use triple mustaches (i.e. <code>{{{standard_fields}}}</code>) so that it isn't escaped.
        </td>
      </tr>
    </table>
    <?php
  }

  public static function form_templates() {
    $options = get_option('runway_stripe_options');
    if(isset($options['form_templates'])) {
      return json_decode($options['form_templates']);
    } else {
      return array();
    }
  }

  public static function form_template_from_id($guid) {
    foreach (self::form_templates() as $template) {
      if($template->guid === $guid) {
        return $template;
      }
    }
  }
}
