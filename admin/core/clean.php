<?php
/**
* This is the core rookie file where most of the
* main functions & features to keep our theme clean.
*
* @copyright Eddie Machado https://github.com/eddiemachado
* @package Rookie Startar
* @since rookie 1.0
*/


// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'rookie_ahoy', 16 );

function rookie_ahoy() {

    // launching operation cleanup
	add_action( 'init', 'rookie_head_cleanup' );
    // remove WP version from RSS
	add_filter( 'the_generator', 'rookie_rss_version' );
    // remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'rookie_remove_wp_widget_recent_comments_style', 1 );
    // clean up comment styles in the head
	add_action( 'wp_head', 'rookie_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
	add_filter( 'gallery_style', 'rookie_remove_gallery_style' );
	// deactivate default gallery CSS
	add_filter( 'use_default_gallery_style', '__return_false' );
    // cleaning up random code around images
	add_filter( 'the_content', 'rookie_filter_ptags_on_images' );
    // cleaning up excerpt
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

} /* end rookie ahoy */

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function rookie_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'rookie_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'rookie_remove_wp_ver_css_js', 9999 );

} /* end rookie head cleanup */

// remove WP version from RSS
function rookie_rss_version() { return ''; }

// remove WP version from scripts
function rookie_remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments
function rookie_remove_wp_widget_recent_comments_style() {
   if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
      remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function rookie_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function rookie_remove_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around images
function rookie_filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// Custom excerpt length
function custom_excerpt_length( $length ) {
	$count = ro_get_option( 'excerpt_length_count', '50' );
	return $count;
}

/**
 * Read more link on all excerpts
 * it works but sometimes it conflict with highlight function @ extra.php file.
 */
	
function new_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


/*
 * This is a modified the_author_posts_link() which just returns the link.
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function rookie_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'rookie' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

/* unregister the default widgets */
function unregister_default_widgets() {
	if( ro_get_option ('default_widgets') ){
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_Categories');
	    unregister_widget('WP_Widget_Pages');
	    unregister_widget('WP_Widget_Calendar');
	    unregister_widget('WP_Widget_Links');
	    unregister_widget('WP_Widget_RSS');
	    unregister_widget('WP_Widget_Tag_Cloud');
	}
}
add_action('widgets_init', 'unregister_default_widgets', 11);


/* Make your WordPress category list valid by removing the “rel” attribute */
function remove_category_rel($string){
  return str_replace('rel="category tag"', '', $string);
}
add_filter('the_category', 'remove_category_rel');


/* Set tag sizes in tag cloud widget */
function set_tag_cloud_sizes($args) {
	$args['smallest'] = 10;
	$args['largest'] = 20;
	return $args;
}
add_filter('widget_tag_cloud_args','set_tag_cloud_sizes');

/*
add_action('switch_theme', 'rookie_setup_options');

function rookie_setup_options () {
  delete_option('ro_get_option');
  delete_option('ro_settings');
}
*/