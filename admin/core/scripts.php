<?php 
/**
* @package Rookie Startar
* @author Abukwaik http://www.croti.com
* @since rookie 1.0
*
*/

/**
    Load needed scripts
**/

function rookie_scripts() {

	wp_enqueue_script('modernizr',      	JS_URI . '/modernizr.min.js', 		array(), '', true);
	wp_enqueue_script('bootstrapjs',    	JS_URI . '/bootstrap.min.js', 		array('jquery'), '', true);
	wp_enqueue_script('plugins',        	JS_URI . '/plugins.min.js', 		array(), '', true);
	wp_enqueue_script('theme-script',   	JS_URI . '/scripts.min.js', 		array(), '', true);

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script('keyboard-image-navigation',   JS_URI . '/keyboard-image-navigation.js');
	}

	if ( (!is_admin()) && is_singular() && comments_open() && !is_front_page() && get_option('thread_comments')) { 
		wp_enqueue_script( 'comment-reply' ); 
	}

	// We dont need these in Frontpage
	if (!is_front_page()) {
		wp_enqueue_script('isotope',        	JS_URI  . '/jquery.isotope.min.js',  array('jquery'), '', true);
		wp_enqueue_script('prettyphoto',     	JS_URI 	. '/jquery.prettyPhoto.min.js',  array('jquery'), '', true );
		wp_enqueue_style ('prettyphoto-css',   	CSS_URI . '/prettyPhoto.min.css');
	}

	wp_localize_script('theme-script', 'rookie', array(
	    'ajaxurl'	=> admin_url( 'admin-ajax.php' ),
	    'nonce' 	=> wp_create_nonce( 'rookie-ajax' )
	));
}
add_action('wp_enqueue_scripts', 'rookie_scripts');


/**
* Generate a dynamic CSS for main style and bootstrap css files
* This technique made a huge improvement to page speed score, simply it raised to 95-99 after this
* But some guys call this "cheating" so i made a fallback option if you don't like that.
* Also it will disable automatically when child theme is activate
* 
* Animate.css and font-awesome are combined into includes/css/all.css and deferred loading by a simple javascript code. See header.php
* For compress_css_code see admin/theme-options.php 
*
* @since rookie 1.0
*/

if (ro_get_option ('dynamiclly_load_css') && !is_child_theme() ) {

	function rookie_dynamic_css(){
		ob_start();
		get_template_part('includes/css/bootstrap.min');
		get_template_part('includes/css/style-css');
		$output = ob_get_contents();
		ob_end_clean();
		return compress_css_code($output);
	}

	function rookie_dynamic_css_output(){
		$dynamic_css_output = trim(preg_replace( '/\s+/', ' ', rookie_dynamic_css()));
		if(!empty($dynamic_css_output)) {
			echo '<style media="all" type="text/css">' . $dynamic_css_output . '</style>';
		}
	}
	add_action('wp_head', 'rookie_dynamic_css_output', 98);

}

else {

	function rookie_stylesheets() {
		wp_enqueue_style('bootstrap', CSS_URI   . '/bootstrap.min.css');
		wp_enqueue_style('style',     CSS_URI   . '/style-css.css');
	}
	add_action('wp_enqueue_scripts', 'rookie_stylesheets', 40);

}


// add HTML5 Shim to header
function IE_support () {
	echo '<!--[if lt IE 9]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv-printshiv.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
	<![endif]-->';
}

add_action('wp_head', 'IE_support');

// Load admin area custom style
function load_admin_scripts(){
	global $pagenow;
	wp_register_style('rookie_admin_css', CSS_URI . '/admin.css', false, 'screen');
	wp_enqueue_style('rookie_admin_css');
}

add_action('admin_enqueue_scripts', 'load_admin_scripts');