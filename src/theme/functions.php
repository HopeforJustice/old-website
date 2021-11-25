<?php
/**
 * hopeforjustice-2014 functions and definitions
 *
 * @package hopeforjustice-2014
 */


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'hopeforjustice_2014_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function hopeforjustice_2014_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on hopeforjustice-2014, use a find and replace
	 * to change 'hopeforjustice-2014' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'hopeforjustice-2014', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'post-thumbnails' );
	        set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
	}

	// This theme uses wp_nav_menu() in one location..
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hopeforjustice-2014' ),
        'norway-primary' => __( 'Norway Primary Menu', 'hopeforjustice-2014' ),
		'mobile' => __( 'Mobile navigation', 'hopeforjustice-2014' ),
        'norway-mobile' => __( 'Norway Mobile navigation', 'hopeforjustice-2014' ),
		'footer-1' => __( 'Footer - 1', 'hopeforjustice-2014'),
        'norway-footer-1' => __( 'Norway Footer - 1', 'hopeforjustice-2014'),
		'footer-2' => __( 'Footer - 2', 'hopeforjustice-2014'),
        'norway-footer-2' => __( 'Norway Footer - 2', 'hopeforjustice-2014'),
		'footer-3' => __( 'Footer - 3', 'hopeforjustice-2014'),
        'norway-footer-3' => __( 'Norway Footer - 3', 'hopeforjustice-2014'),
	) );


	if ( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'hero-full', 1280, 9999 ); 
		add_image_size( 'ad-large', 460, 263, true ); 
		add_image_size( 'ad-small', 280, 183, true );
		add_image_size( 'news-feature-large', 620, 340, true);
		add_image_size( 'news-feature-small', 360, 193, true);
	}

	// Enable support for HTML5 markup.
	add_theme_support( 'html5', array(
		'comment-list',
		'search-form',
		'comment-form',
		'gallery',
	) );
}
endif; // hopeforjustice_2014_setup
add_action( 'after_setup_theme', 'hopeforjustice_2014_setup' );

// Set the default image insert to not add a link
update_option('image_default_link_type','none');

// Set the default excerpt length
function hopeforjustice_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'hopeforjustice_excerpt_length', 999 );

// Set the truncation marker for excerpts
function hopeforjustice_excerpt_more( $excerpt ) {
	return ' …';
}
add_filter( 'excerpt_more', 'hopeforjustice_excerpt_more' );

// Enable the HFJ options page
if(function_exists('acf_add_options_page')) { 
	acf_add_options_page();
}

/**
 * Register widgetized area and update sidebar with default widgets.
 */
// function hopeforjustice_2014_widgets_init() {
//     register_sidebar(array(
//         'id' => 'homepage',
//         'name' => 'Homepage widgets',
//         'description' => 'Widgets to go underneath the main slideshow',
//         'before_widget' => '<section id="%1$s" class="widget %2$s">',
//         'after_widget' => '</section>',
//         'before_title' => '<h3 class="widgettitle">',
//         'after_title' => '</h3>'
//     ));  	
// }
// add_action( 'widgets_init', 'hopeforjustice_2014_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function hopeforjustice_2014_scripts() {

	global $wp_styles;

	wp_enqueue_style( 'hopeforjustice-2014-style', get_stylesheet_uri(), array(), '202133' );

	wp_enqueue_style( 'hopeforjustice-2014-ie9', get_stylesheet_uri() );
	$wp_styles->add_data('hopeforjustice-2014-ie9', 'conditional', '(gt IE 8) | (IEMobile)');

	wp_enqueue_style( 'hopeforjustice-2014-ie8', get_stylesheet_directory_uri() . '/old-ie.css');
	$wp_styles->add_data('hopeforjustice-2014-ie8', 'conditional', '(lt IE 9) & (!IEMobile)');

    // registers modernizr script, stylesheet local path, no dependency, no version, loads in header
    wp_enqueue_script ('hopeforjustice-2014-header', get_stylesheet_directory_uri() . '/assets/js/header.js', array(), false, false);

	wp_enqueue_script('jquery');    

    wp_enqueue_script( 'hopeforjustice-2014-footer', get_template_directory_uri() . '/assets/js/footer.js', array(), '202133', true );

	wp_enqueue_script( 'twitter-widgets', '//platform.twitter.com/widgets.js', array(), '202133', true );
}
add_action( 'wp_enqueue_scripts', 'hopeforjustice_2014_scripts',1 );

/**
 * Enqueue page specific scripts in a centrally maintained location
 */
function page_scripts() {
    global $post;
    wp_register_script( 'handlebars', get_template_directory_uri() . '/assets/js/handlebars.js', '', '202133', true);
    wp_register_script( 'payments', get_template_directory_uri() . '/assets/js/payments.js', array('jquery'), '202133', true);
    wp_register_script( 'parsley-extensions', get_template_directory_uri() . '/assets/js/parsley.js', array('jquery'), '202133', true);


    wp_register_script( 'fundraise-us', get_template_directory_uri() . '/assets/js/pages/fundraise-us.js', array('jquery'), '202133', true);
    wp_register_script( 'twentyone', get_template_directory_uri() . '/assets/js/pages/twentyone.js', array('jquery'), '202133', true); 
    wp_register_script( 'christmas', get_template_directory_uri() . '/assets/js/pages/christmas.js', array('jquery'), '202133', true); 
    wp_register_script( 'emsi', get_template_directory_uri() . '/assets/js/pages/emsi.js', array('jquery'), '202133', true);
    wp_register_script( 'donate-no', get_template_directory_uri() . '/assets/js/pages/donate-no.js', array('jquery', 'parsleyjs'), '202133', true);
    wp_register_script( 'donate-go-cardless', get_template_directory_uri() . '/assets/js/pages/donate-go-cardless.js', array('jquery'), '202133', true);
    wp_register_script( 'donate-stripe', get_template_directory_uri() . '/assets/js/pages/donate-stripe.js', array('jquery'), '202133', true);
    wp_register_script( 'donate-stripe-SCA', get_template_directory_uri() . '/assets/js/pages/donate-stripe-SCA.js', array('jquery'), '202133', true);
    wp_register_script( 'donate-stripe-SCA-testcampaign', get_template_directory_uri() . '/assets/js/pages/donate-stripe-SCA-testcampaign.js', array('jquery'), '202133', true);
    wp_register_script( 'donate-stripe-SCA-USA', get_template_directory_uri() . '/assets/js/pages/donate-stripe-SCA-USA.js', array('jquery'), '202133', true);
    wp_register_script( 'donate-stripe-SCA-USA-once', get_template_directory_uri() . '/assets/js/pages/donate-stripe-SCA-USA-once.js', array('jquery'), '202133', true);
    wp_register_script( 'guardian', get_template_directory_uri() . '/assets/js/pages/guardian.js', array('jquery'), '202133', true);
    wp_register_script( 'campaign', get_template_directory_uri() . '/assets/js/pages/campaign.js', array('jquery'), '202133', true);
    wp_register_script( 'givethegift-uk', get_template_directory_uri() . '/assets/js/pages/givethegift-uk.js', array('jquery'), '202133', true);


    $themeVars = array( 'template_directory_uri' => get_template_directory_uri() );
	
	wp_localize_script( 'fundraise-us', 'theme_vars', $themeVars );
	wp_localize_script( 'emsi', 'theme_vars', $themeVars );
    

        if (is_page('1148')) {
            wp_enqueue_script('handlebars');
            wp_enqueue_script('fundraise-us');
        }
        if (is_page('1379')) {
        	wp_enqueue_script('handlebars');
        	wp_enqueue_script('emsi');
        }
        if (is_page('1863') || is_page('2998') || is_page('3093')) {
            wp_enqueue_script('payments');
            wp_enqueue_script('parsley');
        	wp_enqueue_script('donate-no');
        }
        if (is_page('762')) {
        	wp_enqueue_script('donate-go-cardless');
        }
        if (is_page('2960')) {
        	wp_enqueue_script('donate-stripe-SCA');
        }
        if (is_page('5775') || is_page('5976')) {
        	wp_enqueue_script('donate-stripe-SCA');
        }
        if (is_page('763')) {
        	wp_enqueue_script('donate-stripe-SCA-USA');
        }
        if (is_page('6108') || is_page('6464')) {
        	wp_enqueue_script('donate-stripe-SCA-USA-once');
        }
        if (is_page_template('templates/page-guardian-uk.php')) {
        	wp_enqueue_script('guardian');
        	wp_enqueue_script('donate-go-cardless');
        }
        if (is_page_template('templates/page-guardian.php')) {
            wp_enqueue_script('guardian');
            wp_enqueue_script('donate-stripe-SCA-USA');
        } 
        if (is_page_template('templates/page-christmas.php')) {
        	wp_enqueue_script('christmas');
        	wp_enqueue_script('donate-stripe-SCA');
        } 
        if (is_page_template('templates/page-iwd.php') || is_page_template('templates/page-world-day-against-trafficking.php') || is_page_template('templates/page-campaign.php')) {
        	wp_enqueue_script('campaign');
        	
        }
        if (is_page_template('templates/page-give-the-gift.php')) {
            wp_enqueue_script('givethegift-uk');
        }    

}

add_action('wp_enqueue_scripts', 'page_scripts',1);


/* loads selectivizr in a slightly hacky way - since Wordpress doesn't yet support enqueue with conditional comments in the way that it does for styles:
 * https://core.trac.wordpress.org/ticket/16024
 */
function Selectivizr() {
	echo '<!--[if (gte IE 6)&(lte IE 8)]><script src="'.get_template_directory_uri() . '/js/libs/selectivizr.min.js"></script><![endif]-->';	
}
add_action('wp_head', 'Selectivizr');

/* and for admin */
function my_admin_styles() 
{   
    wp_register_style( 'hfj_admin_style', get_template_directory_uri() . "/inc/admin/hfj_admin_style.css");
    wp_enqueue_style( 'hfj_admin_style' );    
    wp_enqueue_style('thickbox'); 
}
add_action('admin_enqueue_scripts', 'my_admin_styles'); 


/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Shortcodes
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Remove error rate limit on Gravity Forms
 */
add_filter( 'gform_stripe_enable_rate_limits', '__return_false' );


/**
 * Change date format in Gravity Forms
 */
add_action( 'gform_pre_submission_59', 'pre_submission_handler' );
function pre_submission_handler( $form ) {
    // Get the date field.
    $date_field_id = '39';
    $date_field    = GFAPI::get_field( $form, $date_field_id );
    $date = $_POST["input_3"];
    $date = str_replace('/', '-', $date);
    $date = date("Ymd", strtotime($date));
    $_POST["input_3"] = $date;
}

/**
 * Stop Gravity Forms scroll
 */
add_filter( 'gform_confirmation_anchor', '__return_false' );


/**
 * Gravity Forms go to first error
 */
function gf_scroll_to_first_error_focus( $form ) {
    ?>
    <script type="text/javascript">
        if( window['jQuery'] ) {
            ( function( $ ) {
                $( document ).bind( 'gform_post_render', function() {
                    var $firstError = $( 'li.gfield.gfield_error:first' );
                    if( $firstError.length > 0 ) {
                        $firstError.find( 'input, select, textarea' ).eq( 0 ).focus();
                        document.body.scrollTop = $firstError.offset().top;
                    }
                } );
            } )( jQuery );
        }
    </script>
    <?php
    return $form;
}
add_action( 'gform_pre_render', 'gf_scroll_to_first_error_focus', 10, 1 );

/**
 * credit card styling
 */
add_filter( 'gform_stripe_elements_style', 'set_stripe_styles', 10, 2 );
function set_stripe_styles( $cardStyles, $formId){
    $cardStyles['base'] = array(
        'fontSize'      => '16px',
    );
    $cardStyles['invalid'] = array(
                                'color' => '#e5424d',
                                ':focus' => array( 'color' => 'red' )
                            );
    return $cardStyles;

}


