<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package hopeforjustice-2014
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function hopeforjustice_2014_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hopeforjustice_2014_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hopeforjustice_2014_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'hopeforjustice_2014_body_classes' );

/**
 * Callback function to insert 'styleselect' into the $buttons array 
 * - adds the "formats" dropdown to TinyMCE
 *
 */
function my_mce_buttons_2( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}
// Register our callback to the appropriate filter
add_filter('mce_buttons_2', 'my_mce_buttons_2');

/**
 * Callback function to filter the MCE settings
 * - adds styles into the "formats" dropdown
 *
 */

// Callback function to filter the MCE settings
function my_mce_before_init_insert_formats( $init_array ) {  
	// Define the style_formats array
	$style_formats = array(  
		// Each array child is a format with it's own settings
		array(  
			'title' => 'Alpha (h1) text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span', 
			'classes' => 'alpha',
		),
		array(  
			'title' => 'Beta (h2) text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span', 
			'classes' => 'beta',
		),
		array(  
			'title' => 'Gamma (h3) text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span', 
			'classes' => 'gamma',
		),
		array(
			'title' => 'Delta (h4) text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span', 
			'classes' => 'delta',
		),
		array(
			'title' => 'Giga text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span', 
			'classes' => 'giga',
		),
		array(
			'title' => 'Mega text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span', 
			'classes' => 'mega',
		),
		array(
			'title' => 'Kilo (ask) text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,blockquote,div,span', 
			'classes' => 'kilo',
		),
		array(
			'title' => 'Large body text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,blockquote,div,span', 
			'classes' => 'text--large-print',
		),			
		array(  
			'title' => 'Left aligned text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'text--left',
		),
		array(  
			'title' => 'Centered text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'text--center',
		),
		array(  
			'title' => 'Right aligned text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'text--right',
		),
		array(  
			'title' => 'Push bottom',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'push--bottom',
		),
		array(  
			'title' => 'Push half bottom',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'push-half--bottom',
		),
		array(  
			'title' => 'Push double bottom',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'push-double--bottom',
		),		
		array(  
			'title' => 'Hard bottom',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'hard--bottom',
		),
		array(  
			'title' => 'Push top',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'push--top',
		),
		array(  
			'title' => 'Push half top',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'push-half--top',
		),
		array(  
			'title' => 'Hard top',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li',
			'classes' => 'hard--top',
		),		
		array(  
			'title' => 'Light gray text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--light',
		),
		array(  
			'title' => 'Dark gray text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--dark-gray',
		),		
		array(  
			'title' => 'Blue text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--blue',
		),
		array(  
			'title' => 'Light blue text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--light-blue',
		),		
		array(  
			'title' => 'Red text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--red',
		),
		array(  
			'title' => 'Green text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--green',
		),
		array(  
			'title' => 'White text',  
			'selector' => 'p,h1,h2,h3,h4,h5,h6,td,th,div,span,ul,ol,li', 
			'classes' => 'text--white',
		),

	);  
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 


/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function hopeforjustice_2014_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'hopeforjustice-2014' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'hopeforjustice_2014_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function hopeforjustice_2014_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'hopeforjustice_2014_setup_author' );

/**
 * Pass in a location - get the menu title (used for the footer titles)
 *
 * @param string $location menu location passed in
 * @return array 
 */
function hopeforjustice_get_menu_by_location( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
}
/**
 * Get rid of hard-coded image dimensions on responsive sites
 *
 */
add_filter( 'post_thumbnail_html', 'hopeforjustice_remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'hopeforjustice_remove_thumbnail_dimensions', 10 );

function hopeforjustice_remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/**
 *
 * Moves Gravity Forms js into the footer
 *
 * This is done so that we get much better styling control over the button.
 *
 */

add_filter("gform_init_scripts_footer", "init_scripts");
function init_scripts() {
	return true;
}


/**
 *
 * Replace Gravity forms <input type="submit"> with <button>
 *
 * This is done so that we get much better styling control over the button.
 *
 */

add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){
	$button = ($form['button']['text'] != '' ? $form['button']['text'] : 'Submit');
    return "<button class='button--gray button--solid' id='gform_submit_button_{$form["id"]}'><span>". $button ."</span></button>";
}

/**
 *
 * Gravity forms custom hook for Hope Challenge 2017
 *
 * using 'popuplate dynamically' and 'supporting' will populate a hidden field with a random number 
 * from 1-29 to allocate people to rescued people
 *
 */

add_filter("gform_field_value_supporting", "generate_random_number");
function generate_random_number($value){
   return rand (1, 17);
}

/**
 *
 * Remove head items which aren't needed
 *
 */

remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version

/**
 *
 * Ensure that on SSL pages image object URLs are loaded over https (should be fixed in WP4.0)
 *
 */

function ssl_post_thumbnail_urls($url, $post_id) {

  //Skip file attachments
  if(!wp_attachment_is_image($post_id)) {
    return $url;
  }

  //Correct protocol for https connections
  list($protocol, $uri) = explode('://', $url, 2);

  if(is_ssl()) {
    if('http' == $protocol) {
      $protocol = 'https';
    }
  } else {
    if('https' == $protocol) {
      $protocol = 'http';
    }
  }

  return $protocol.'://'.$uri;
}
add_filter('wp_get_attachment_url', 'ssl_post_thumbnail_urls', 10, 2);

/**
 *
 * Customise the nav menu output for the mobile menu
 *
 */


class MobileNav extends Walker_Nav_Menu
{
    function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

	function start_el(&$output, $item, $depth = 0, $args = Array(), $id = 0)
    {
        global $wp_query;
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

        $output .= $indent . '<li' . $id . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        if (!empty($item->url)) {
        	$attributes .= ($item->hasChildren) ? ' href="#"' : ' href="'   . esc_attr( $item->url        ) .'"';
        };
        $attributes .= ($item->hasChildren) ? ' class="sub-menu-toggle"' : ' class="menu-item-link"';

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';

        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;

        $item_output .= ($item->hasChildren) ? '<span class="gi-plus"></span>' : '';
        $item_output .= '</a>';
        
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
    }
}

/**
 *
 * Customise the get categories output for better classes
 *
 */

class HFJCats_Walker extends Walker_Category {
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);
		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$termchildren = get_term_children( $category->term_id, $category->taxonomy );
		$aclass = "cat-nav__link button--black button--solid";
		if(count($termchildren)>0){
			$aclass .=  ' cat-nav__link__parent';
		}
		$link = '<a class="'.$aclass.'" href="' . esc_url( get_term_link($category) ) . '" ';
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title="' . esc_attr( sprintf(__( 'View all posts filed under %s' ), $cat_name) ) . '"';
		else
			$link .= 'title="' . esc_attr( strip_tags( apply_filters( 'category_description', $category->description, $category ) ) ) . '"';
		$link .= '>';
		$link .= $cat_name . '</a>';
		if ( !empty($show_count) )
			$link .= ' (' . intval($category->count) . ')';
		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-nav__item';
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' cat-nav__item__current';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' cat-nav__item__parent';
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}
}
/**
 *
 * Customise the search form
 *
 */
function hopeforjustice_2014_search_form( $form ) {
	$form = '<form role="search" method="get" id="searchform" class="search-form" action="' . home_url( '/' ) . '" >
	<div class="search-form__input-wrapper"><label class="screen-reader-text" for="s">' . __( 'Search for:' ) . '</label>
	<input type="search" value="' . get_search_query() . '" name="s" id="s" class="search-form__input" placeholder="Search…"/></div>
	<div class="search-form__action"><button class="button button--solid button--black button--block search-form__button" type="submit" id="searchsubmit">'.esc_attr__( 'Search' ).'</button></div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'hopeforjustice_2014_search_form' );

/**
 *
 * Return only posts in search results
 *
 */
function SearchFilter($query) {
if ($query->is_search && !is_admin() ) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','SearchFilter');

/**
 *
 * Enable jsapi for youtube oembed
 *
 */

function my_plugin_enable_js_api( $html, $url, $args ) {
 
    /* Modify video parameters. */
    if ( strstr( $html,'youtube.com/embed/' ) ) {
        $html = str_replace( '?feature=oembed', '?feature=oembed&enablejsapi=1', $html );
    }
    
    return $html;
}
add_filter( 'oembed_result', 'my_plugin_enable_js_api', 10, 3 );

?>