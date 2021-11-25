<?php

defined('ABSPATH') or die("No script kiddies please!");

add_action( 'wp_enqueue_scripts', 'runway_stripe_register_scripts' );

function runway_stripe_register_scripts() {
  global $runway_stripe_plugin_version;

  wp_register_script( 'parsleyjs', plugins_url( 'js/parsley.min.js' , dirname(__FILE__) ), array(), '2.0.5', true );
  wp_register_script( 'runway-donation-form', plugins_url( 'js/donation-form.js' , dirname(__FILE__) ), array('parsleyjs'), $runway_stripe_plugin_version, true );
  wp_register_script( 'stripe-checkout', 'https://checkout.stripe.com/checkout.js');
  wp_register_script( 'stripe-js', 'https://js.stripe.com/v2/');
}

function runway_stripe_get_shortcode_option($key, $atts, $default, $isInteger) {
  global $runway_stripe_shortcode_setting_prefix;
  // First look for the value on the query string (with a specific prefix), then as a shortcode, then fall back to the default.
  $value = $default;
  if(isset($_GET["$runway_stripe_shortcode_setting_prefix$key"])) {
    $value = $_GET["$runway_stripe_shortcode_setting_prefix$key"];
  } else if(isset($atts[$key])) {
    $value = $atts[$key];
  }

  if($isInteger) {
    if (!is_numeric($value)) {
      $value = $default;
    }
    $value = intval($value);
  }

  return $value;
}

function runway_stripe_donations_render_shortcode($atts) {
  if(class_exists('Stripe')) {
    return '<p style="color: red;">The Stripe class has already been loaded. Have you got another Stripe plugin active?</p>';
  }

  require __DIR__.'/../lib/phly_mustache/library/Phly/Mustache/_autoload.php';
  global $runway_stripe_shortcode_setting_prefix;

  wp_enqueue_script( 'runway-donation-form' );

  $options = get_option('runway_stripe_options');
  $account = $atts['account'];
  $currency = runway_stripe_get_shortcode_option('currency', $atts, $options["account_{$account}_currency"], false);

  $mustache_data = array(
    'account' => $account,
    'setting_prefix' => $runway_stripe_shortcode_setting_prefix,
    'site_name' => get_bloginfo('name'),

    'amount_regular' => runway_stripe_get_shortcode_option('amount_regular', $atts, 30, true),
    'amount_one_off' => runway_stripe_get_shortcode_option('amount_one_off', $atts, 30, true),
    'amount_regular_is_default' => runway_stripe_get_shortcode_option('amount_regular', $atts, -1, true) === -1,

    'campaign' => runway_stripe_get_shortcode_option('campaign', $atts, '', false),
    'event' => runway_stripe_get_shortcode_option('event', $atts, '', false),
    'use_tabs' => strtolower(runway_stripe_get_shortcode_option('use_tabs', $atts, 'false', false)) === 'true',
    'error_message' => isset($_GET['error_message']) ? $_GET['error_message'] : '',
    'cancel_url' => $_SERVER['REQUEST_URI'],
    'thank_you_url' => runway_stripe_get_shortcode_option('thank_you_url', $atts, $options['thank_you_url'], false),

    'currency' => $currency,
    'input_css_class' => $currency == 'GBP' ? 'input--pre-pound' : 'input--pre-dollar',
    'form_layout' => runway_stripe_get_shortcode_option('form_layout', $atts, '', false),
    'image_url' => $options['image_url'],
    'stripe_key' => $options["account_{$account}_publishable_key"],
    'submit_url' => plugins_url('take-payment.php', dirname(__FILE__)),
    'form_id' => uniqid(),
    'button_text' => runway_stripe_get_shortcode_option('button_text', $atts, 'Donate', false),
    'button_class' => runway_stripe_get_shortcode_option('button_class', $atts, 'button--orange button--solid button--large', false),

    'nonce' => wp_create_nonce('runway-stripe-donate_take-payment')
  );

  $mustache_data['data_as_json'] = json_encode($mustache_data);

  $mustache = new Phly\Mustache\Mustache();

  $mustache_data['standard_fields'] = $mustache->render('
    <input type="hidden" name="account" value="{{account}}" />
    <input type="hidden" name="currency" value="{{currency}}" />
    <input type="hidden" name="campaign" value="{{campaign}}" />
    <input type="hidden" name="event" value="{{event}}" />
    <input type="hidden" name="cancel_url" value="{{cancel_url}}" />
    <input type="hidden" name="return_url" value="{{thank_you_url}}" />
    <input type="hidden" name="_wpnonce" value="{{nonce}}" />
  ', $mustache_data);

  $form_template_id = isset($options["account_{$account}_form_template"]) ? $options["account_{$account}_form_template"] : '';
  $form_template = RunwayStripeSettings::form_template_from_id($form_template_id);

  if($form_template) {
    // Using a form template, so we must be using Stripe.js
    wp_enqueue_script( 'stripe-js' );
    return $mustache->render($form_template->body, $mustache_data);
  } else {
    // No form template. We use out own code for Stripe checkout.
    wp_enqueue_script( 'stripe-checkout' );

    return $mustache->render('
      <form id="donation-form-{{form_id}}" class="donation-form{{#form_layout}} donation-form--{{form_layout}}{{/form_layout}}" method="post" action="{{submit_url}}" data-parsley-validate data-parsley-errors-container=".donate-forms">
        {{#error_message}}
          <div class="donation-form__error">{{error_message}}</div>
        {{/error_message}}
        <div class="input {{input_css_class}}">
          <input class="donation-form__donation-input" type="number" step="any" value="{{amount_regular}}" tabindex="1" placeholder="donation amount" min="1" required data-parsley-min-message="The minimum donation we can process online is $1" data-parsley-required-message="Please enter an amount."/>
        </div>

        <input type="hidden" name="email" />
        <input type="hidden" name="stripeToken" />
        <input type="hidden" name="monthly" />
        <input type="hidden" name="donation_amount" />
        {{{standard_fields}}}
      </form>
      <button id="donation-form-button-{{form_id}}" class="donation-form__button button {{button_class}}">{{button_text}}</button>
      <script type="text/javascript">
        jQuery(function ($) {
          runway_donations.init_checkout({{{data_as_json}}});
        });
      </script>
    ', $mustache_data);
  }
}

add_shortcode('runway-stripe-donations', 'runway_stripe_donations_render_shortcode');
