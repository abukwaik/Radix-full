<?php
/**
 *
 * Redux framework functions
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 */


/**
	Change customizer link
*/
/* Change customize link to theme options instead of live customizer */
function change_customize_link($themes) {
	if(array_key_exists('_rookie', $themes)) {
		$themes['_rookie']['actions']['customize'] = admin_url('admin.php?page=rookie_options');
	}
	return $themes;
}
add_filter('wp_prepare_themes_for_js', 'change_customize_link');


/**
	Theme option function
*/

/* Generate theme option CSS */
function generate_option_css(){
	ob_start();
	get_template_part('admin/options-css');
	$output = ob_get_contents();
	ob_end_clean();
	return compress_css_code($output);
}
/* add to head including favicons and custom css */
function rookie_wp_head(){
	// Add favicons
	if($favicon = ro_get_option_media('favicon')) {
		echo '<link rel="shortcut icon" href="'.$favicon.'" type="image/x-icon" />';
	}
	// Add apple touch icon
	if($apple_touch_icon = ro_get_option_media('apple_touch_icon')) {
		echo '<link rel="apple-touch-icon" href="'.$apple_touch_icon.'" />';
	}
	// Theme option CSS output
	$option_css = trim(preg_replace( '/\s+/', ' ', generate_option_css()));
	if(!empty($option_css)) {
		echo '<style media="all" type="text/css">'.$option_css.'</style>';
	}
	// Custom CSS
	$custom_css = trim(preg_replace( '/\s+/', ' ', ro_get_option('custom_css')));
	if(!empty($custom_css)) {
		echo '<style media="all" type="text/css">'.$custom_css.'</style>';
	}
}
add_action('wp_head', 'rookie_wp_head', 99);


/* Compress CSS output */
function compress_css_code($code) {
	// Remove Comments
	$code = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $code);

	// Remove tabs, spaces, newlines, etc.
	$code = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $code);
	return $code;
}

/* Get theme option function */ 
function ro_get_option($option){
	global $ro_settings;
	if(isset($ro_settings[$option])){
		return $ro_settings[$option];
	} else {
		return false;
	}
}

/* Update theme option function */ 
function ro_update_option($key = false, $value = false){
	global $Redux_Options;
	if(!empty($key)){
		$Redux_Options->set($key, $value);
	} 
}

/* Add custom Login logo */
function ro_login_logo() {
  $custom_login_logo = ro_get_option_media('custom_login_logo');
  $custom_login_bg = ro_get_option_media('custom_login_bg');
  if(!empty($custom_login_logo)) {
    echo '
    <style type="text/css">
      body.login #login h1 a { background: url('.esc_url($custom_login_logo).') no-repeat top transparent;
        height:10vh; width:100%; }
        body.login { background-image: url('.esc_url($custom_login_bg).');
        background-repeat: no-repeat; background-size: cover; }
        .login form { box-shadow: 0 1px 5px rgba(0, 0, 0, 0.20); }
    </style>';
  }
}
add_action('login_head', 'ro_login_logo');

/* Add custom link to new Login logo */
function ro_login_url($url) {

	return home_url();
}
add_filter( 'login_headerurl', 'ro_login_url' );

/* Maintenance mode.*/
function ro_maintenance_mode(){  
  if( ro_get_option ('maintenance_mode') ){  
    wp_die('Maintenance, please come back soon.', 'Maintenance - please come back soon.', array('response' => '503'));  
  }  
}
add_action('get_header', 'ro_maintenance_mode');

/* Additional JS output into theme footer if specified in theme options */
function ro_wp_footer(){
	
	//Additional JS
	$custom_js = trim(preg_replace( '/\s+/', ' ', ro_get_option('custom_js')));
	if(!empty($custom_js)) {
		echo '<script type="text/javascript">
			/* <![CDATA[ */
				'.$custom_js.'
			/* ]]> */
			</script>';
	}

	//Google Analytics (tracking)
	if($ga = ro_get_option('ga')) {
		echo $ga;
	}
}
add_action('wp_footer', 'ro_wp_footer', 99);

/* Convert hexdec color string to rgba */
function ro_hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';

	//Return default if no color provided
	if(empty($color))
		return $default;

	//Sanitize $color if "#" is provided
	if ($color[0] == '#' ) {
		$color = substr( $color, 1 );
	}

  //Check if color has 6 or 3 characters and get values
	if (strlen($color) == 6) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return $default;
	}

  //Convert hexadec to rgb
	$rgb = array_map('hexdec', $hex);

  //Check if opacity is set(rgba or rgb)
	if($opacity){
		if(abs($opacity) > 1){ $opacity = 1.0; }
		$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
	} else {
		$output = 'rgb('.implode(",",$rgb).')';
	}

  //Return rgb(a) color string
	return $output;
}

/* Get image option url */
function ro_get_option_media($option){
	$media = ro_get_option($option);
	if(isset($media['url']) && !empty($media['url'])){
		return $media['url'];
	}
	return false;
}