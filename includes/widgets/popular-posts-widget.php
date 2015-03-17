<?php
/*
Plugin Name: Bootstrap Carousel Widget
Plugin URI: TODO
Description: Simple WordPress slider widget utilizing Bootstrap carousel.
Version: 1.0
Author: Ben Brandt
Author URI: http://benjaminbrandt.com
Author Email: benjamin.j.brandt@gmail.com
Text Domain: bs-carousel-widget
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Copyright 2013 Ben Brandt (benjamin.j.brandt@gmail.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/
class BS_Carousel extends WP_Widget {
/*--------------------------------------------------*/
/* Constructor
/*--------------------------------------------------*/
/**
* Specifies the classname and description, instantiates the widget,
* loads localization files, and includes necessary stylesheets and JavaScript.
*/
public function __construct() {
// load plugin text domain
add_action( 'init', array( $this, 'widget_textdomain' ) );
// Hooks fired when the Widget is activated and deactivated
register_activation_hook( __FILE__, array( $this, 'activate' ) );
register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
parent::__construct(
'widget-name-id',
__( 'Bootstrap Carousel', 'bs-carousel-widget' ),
array(
'classname' =>  'bs-carousel-class',
'description'   =>  __( 'Bootstrap Carousel Widget', 'bs-carousel-widget' )
)
);
// Register admin styles and scripts
add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
// Register site styles and scripts
add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );
} // end constructor
/*--------------------------------------------------*/
/* Widget API Functions
/*--------------------------------------------------*/
/**
* Outputs the content of the widget.
*
* @param array args The array of form elements
* @param array instance The current instance of the widget
*/
public function widget( $args, $instance ) {
extract( $args, EXTR_SKIP );
echo $before_widget;
// Item 1
$item1_src = empty( $instance['item1_src']) ? '' : apply_filters( 'item1_src', $instance['item1_src'] );
$item1_url = empty( $instance['item1_url']) ? '' : apply_filters( 'item1_url', $instance['item1_url'] );
// Item 2
$item2_src = empty( $instance['item2_src']) ? '' : apply_filters( 'item2_src', $instance['item2_src'] );
$item2_url = empty( $instance['item2_url']) ? '' : apply_filters( 'item2_url', $instance['item2_url'] );
// Item 3
$item3_src = empty( $instance['item3_src']) ? '' : apply_filters( 'item3_src', $instance['item3_src'] );
$item3_url = empty( $instance['item3_url']) ? '' : apply_filters( 'item3_url', $instance['item3_url'] );
include THEME_DIR . '/core/widget.php';
echo $after_widget;
} // end widget
/**
* Processes the widget's options to be saved.
*
* @param array new_instance The new instance of values to be generated via the update.
* @param array old_instance The previous instance of values before the update.
*/
public function update( $new_instance, $old_instance ) {
$instance = $old_instance;
// Item 1
$instance['item1_src'] = strip_tags( stripslashes( $new_instance['item1_src'] ) );
$instance['item1_url'] = strip_tags( stripslashes( $new_instance['item1_url'] ) );
// Item 2
$instance['item2_src'] = strip_tags( stripslashes( $new_instance['item2_src'] ) );
$instance['item2_url'] = strip_tags( stripslashes( $new_instance['item2_url'] ) );
// Item 3
$instance['item3_src'] = strip_tags( stripslashes( $new_instance['item3_src'] ) );
$instance['item3_url'] = strip_tags( stripslashes( $new_instance['item3_url'] ) );
return $instance;
} // end widget
/**
* Generates the administration form for the widget.
*
* @param array instance The array of keys and values for the widget.
*/
public function form( $instance ) {
$instance = wp_parse_args(
(array) $instance,
array(
'item1_src' => '',
'item1_url' => '',
'item2_src' => '',
'item2_url' =>  '',
'item3_src' => '',
'item3_url' =>  ''
)
);
// Item 1
$item1_src = esc_url( $instance['item1_src'] );
$item1_url = esc_url( $instance['item1_url'] );
// Item 2
$item2_src = esc_url( $instance['item2_src'] );
$item2_url = esc_url( $instance['item2_url'] );
// Item 3
$item3_src = esc_url( $instance['item3_src'] );
$item3_url = esc_url( $instance['item3_url'] );
// Display the admin form
include THEME_DIR . '/core/admin.php';
} // end form
/*--------------------------------------------------*/
/* Public Functions
/*--------------------------------------------------*/
/**
* Loads the Widget's text domain for localization and translation.
*/
public function widget_textdomain() {
load_plugin_textdomain( 'bs-carousel-widget', false, plugin_dir_path( __FILE__ ) . 'lang/' );
} // end widget_textdomain
/**
* Fired when the plugin is activated.
*
* @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
*/
public function activate( $network_wide ) {
// TODO define activation functionality here
} // end activate
/**
* Fired when the plugin is deactivated.
*
* @param boolean $network_wide True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
*/
public function deactivate( $network_wide ) {
// TODO define deactivation functionality here
} // end deactivate
/**
* Registers and enqueues admin-specific styles.
*/
public function register_admin_styles() {
wp_enqueue_style( 'bs-carousel-widget-admin-styles', plugins_url( 'bs-carousel-widget/css/admin.css' ) );
} // end register_admin_styles
/**
* Registers and enqueues admin-specific JavaScript.
*/
public function register_admin_scripts() {
wp_enqueue_script( 'bs-carousel-widget-admin-script', plugins_url( 'bs-carousel-widget/js/admin-ck.js' ), array('jquery') );
} // end register_admin_scripts
/**
* Registers and enqueues widget-specific styles.
*/
public function register_widget_styles() {
wp_enqueue_style( 'bs-carousel-widget-widget-styles', plugins_url( 'bs-carousel-widget/css/widget.css' ) );
} // end register_widget_styles
/**
* Registers and enqueues widget-specific JavaScript.
*/
public function register_widget_scripts() {
wp_enqueue_script( 'bs-carousel-widget-admin-script', plugins_url( 'bs-carousel-widget/js/widget-ck.js' ), array('jquery') );
} // end register_admin_scripts
/**
* Renders the image for the specified item.
*
* @param string $item*_src The source of the image file
* @param string $item*_url The URL of the advertisement
* @param int $number The ID of the advertisement
* @return string $html The markup for the
* @since 3.2
* @version 1.0
*/
private function display_item( $item_src, $item_url, $number ) {
$html = '';
// Use the default ad if it's not specified
if( 0 == strlen( trim( $item_src ) ) ) {
if( 0 == strlen( trim( $item_url ) ) ) {
$item_url = 'http://benjaminbrandt.com';
} // end if
$item_src = '<img src="http://placehold.it/900x350" alt="" />'; 
} else {
$item_src = '<img src="' . $item_src . '" alt="" />';
} // end if
// Check to see if the URL is empty
if( 0 != strlen( trim( $item_url ) ) ) {
$html = '<a href="' . $item_url . '">';
$html .= $item_src;
$html .= '</a>';
} else {
$html .= $item_src;
} // end if
return $html;
} // end display_item
} // end class
add_action( 'widgets_init', create_function( '', 'register_widget("BS_Carousel");' ) );