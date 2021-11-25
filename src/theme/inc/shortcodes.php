<?php 

/**
 * Shortcodes
 *
 * Useful widgets for the editor...
 *
 * @package hopeforjustice-2014
 */


/**
 * [sharing]
 */

function sharing_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array(  
        'text' => 'Currently reading about how @hopeforjustice are working to beat Modern Slavery'
    ), $atts));

    $pageURL = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];

    // enqueue page specific plugins

    $share_text = urlencode($text);
    $return_string = '<div class="share"><a href="https://twitter.com/intent/tweet?text='.$share_text.'&url='.$pageURL.'&via=HopeforJustice" class="gi-twitter" rel="nofollow" title="Share on Twitter" target="_blank"><span class="screen-reader-text">Tweet this</span></a>';
    $return_string .= '<a href="https://www.facebook.com/dialog/feed?app_id=442456682483519&display=popup&caption='.$share_text.'&link='.$pageURL.'&redirect_uri='.$pageURL.'" class="gi-facebook" rel="nofollow" title="Share on Facebook" target="_blank"><span class="screen-reader-text">Share this on Facebook</span></a></div>';
    return $return_string;
}
add_shortcode( 'sharing', 'sharing_shortcode' );

// Register the sharing button in Tiny MCE

function register_sharing_button( $buttons ) {
   array_push( $buttons, "|", "sharing" );
   return $buttons;
}

function add_sharing_plugin( $plugin_array ) {
   $plugin_array['sharing'] = get_template_directory_uri() . '/assets/js/admin/mce-extensions.js';
   return $plugin_array;
}

function my_sharing_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_sharing_plugin' );
      add_filter( 'mce_buttons', 'register_sharing_button' );
   }

}

add_action('init', 'my_sharing_button');

/**
 * [action buttons]
 */

function actioncontainer_shortcode( $atts = null, $content = null) {
    extract(shortcode_atts(array( 
        'alignment' => '',
        'class' => ''
    ), $atts));
    switch ($alignment) {
      case "left":
      $alignment = " text--left";
      break;
      case "center":
      $alignment = " text--center";
      break;
      case "right":
      $alignment = " text--right";
      default: 
      $alignment = "";
    }
  return '<ul class="actions' .esc_attr($alignment).' '. esc_attr($class) .'">'.do_shortcode(shortcode_unautop($content)).'</ul>';
}
add_shortcode( 'action_buttons', 'actioncontainer_shortcode' );

function actionbutton_shortcode( $atts, $content = null ){
    extract(shortcode_atts(array( 
        'label' => '',
        'style' => 'filled',
        'url' => '',
        'target' => '_self',
        'color' => 'default',
        'size' => 'default'
    ), $atts));

    $return_string = '<li class="actions__item"><a href="'.$url.'" target="'.$target.'" class="button ';
    if ( $size != 'default' ) {
      $return_string .= ' button--'.$size;
    }
    $return_string .= ' button--'.$color;
    $return_string .= ' button--'.$style;
    $return_string .= '">'.$label.'</a></li>';
    return $return_string;
}
add_shortcode( 'button', 'actionbutton_shortcode' );

// Register the shortcode button in Tiny MCE
function register_actionbuttons_button( $actionbuttons ) {
   array_push( $actionbuttons, "|", "actionbuttons" );
   return $actionbuttons;
}

function add_actionbuttons_plugin( $plugin_array ) {
   $plugin_array['actionbuttons'] = get_template_directory_uri() . '/assets/js/admin/mce-extensions.js';
   return $plugin_array;
}

function my_actionbuttons_button() {

   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') ) {
      return;
   }

   if ( get_user_option('rich_editing') == 'true' ) {
      add_filter( 'mce_external_plugins', 'add_actionbuttons_plugin' );
      add_filter( 'mce_buttons', 'register_actionbuttons_button' );
   }

}

add_action('init', 'my_actionbuttons_button');