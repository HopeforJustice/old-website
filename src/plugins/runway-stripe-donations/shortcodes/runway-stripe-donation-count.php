<?php

function runway_stripe_donation_count_render_shortcode($atts) {
  $campaign = 'None';
  if(isset($atts['campaign']) && $atts['campaign']) {
    $campaign = trim($atts['campaign']);
  }
  $option_key = 'runway_stripe_donation_count-'.sanitize_title($campaign);

  return get_option($option_key, 0);
}

add_shortcode('runway-stripe-donation-count', 'runway_stripe_donation_count_render_shortcode');
