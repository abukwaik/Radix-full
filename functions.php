<?php

/**
 * Rookie - setup functions and definitions
 * 
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 * 
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @copyright Copyright (c) 2015, Rookie
 * @license http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @since rookie 1.0
 *
 */

define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());
define('THEME_NAME', 'Rookie');
define('THEME_SLUG', 'rookie');
define('THEME_VERSION', '1.1');
define('THEME_OPTIONS', 'ro_settings');
define('JS_URI',  THEME_URI . '/includes/js');
define('CSS_URI', THEME_URI . '/includes/css');
define('IMG_DIR', THEME_DIR . '/images');
define('IMG_URI', THEME_URI . '/images');

if ( ! isset( $content_width )) {
  $content_width = 669; 
}

// Set the content width for full width pages with no sidebar.
function rookie_content_width() {
  if ( is_page_template( 'page-fullwidth.php' ) || is_page_template( 'front-page.php' ) ) {
    global $content_width;
    $content_width = 1170;
  }
}
add_action( 'template_redirect', 'rookie_content_width' );


/**
    Theme setup
**/

if ( !function_exists( 'rookie_setup' ) ) {

  function rookie_setup() {
    add_theme_support( 'automatic-feed-links');
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'video' ));
    load_theme_textdomain( 'rookie', THEME_DIR . '/languages' );
    register_nav_menu( 'primary', 'Primary' );
    register_nav_menu( 'footer-menu', 'Footer Menu' );
    add_theme_support('post-thumbnails');
    add_editor_style( CSS_URI . '/editor-style.css' );

    // allows users to set a custom background.
    add_theme_support( 'custom-background', apply_filters( 'twentyfourteen_custom_background_args', array(
      'default-color' => 'f5f5f5',
      )));

    //add image sizes
    if ( function_exists('add_image_size')) {
      add_image_size('featured_image', 669, 272, true);
      add_image_size('small-thumb', 50, 50, true);
      add_image_size('team-four', 219, 219, true);
      add_image_size('medium-thumb', 300, 300, true);
      add_image_size('album-grid', 450, 450, true);
      add_image_size('full-size', 9999, 9999, false);
    }
  }
}

add_action( 'after_setup_theme', 'rookie_setup' );

/**
  Title backwards compatibility for old WP versions
*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
  function theme_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
  }
  add_action( 'wp_head', 'theme_slug_render_title' );
}

/**
    Twitter Handler
**/
function ro_twitter($limit = 1  , $twitter_id = '' , $enable_id) {

  require_once THEME_DIR . '/includes/widgets/twitter_oauth/twitteroauth.php';
  $consumer_key = ro_get_option('twitter_consumer_key');
  $consumer_secret = ro_get_option ('twitter_consumer_secret');
  $access_token = ro_get_option('twitter_access_token');
  $access_token_secret = ro_get_option ('twitter_access_token_secret');
  $settings = array(
    'oauth_access_token' => $access_token,
    'oauth_access_token_secret' => $access_token_secret,
    'consumer_key' => $consumer_key,
    'consumer_secret' => $consumer_secret
    );

  $twitterconn = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
  $latesttweets = $twitterconn->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitter_id."&count=".$limit);
  if($consumer_key != '' && $consumer_secret != '' && $access_token != '' && $access_token_secret != '') {

    foreach($latesttweets as $tweet ){
      echo '<div class="tweet"><p>';
      $output = preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a class="custom" href="$1" target="_blank">$1</a>', $tweet->text);
      echo preg_replace('/(^|\s)@([a-z0-9_]+)/i',
        '$1<a href="http://www.twitter.com/$2">@$2</a>',
        $output);
      echo '</p></div>';
    }

    if($enable_id == 'true') {
      echo '<a target="_blank" href="http://twitter.com/'.$twitter_id.'" class="twitter-follow-button">'.__('Follow' , 'rookie').'</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>';

    }
  }
}

/**
    Post Feedback
**/

function rookie_ajax_feedback() {
    check_ajax_referer( 'rookie-ajax' );
    $template = '<div class="alert alert-%s">%s</div>';
    $previous = isset( $_COOKIE['rookie_response'] ) ? explode( ',', $_COOKIE['rookie_response'] ) : array();
    $post_id = intval( $_POST['post_id'] );
    $type = in_array( $_POST['type'], array( 'positive', 'negative' ) ) ? $_POST['type'] : false;

    // check previous response
    if ( in_array( $post_id, $previous ) ) {
        $message = sprintf( $template, 'danger', __( 'Sorry, you\'ve already recorded your feedback!', 'rookie' ) );
        wp_send_json_error( $message );
    }

    // if new
    if ( $type ) {
        $count = (int) get_post_meta( $post_id, $type, true );
        update_post_meta( $post_id, $type, $count + 1 );
        array_push( $previous, $post_id );
        $cookie_val = implode( ',',  $previous);
        $val = setcookie( 'rookie_response', $cookie_val, time() + WEEK_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    }

    $message = sprintf( $template, 'warning', __( 'Thanks for your feedback!', 'rookie' ) );
    wp_send_json_success( $message );
    exit;
}

add_action( 'wp_ajax_rookie_ajax_feedback', 'rookie_ajax_feedback' );
add_action( 'wp_ajax_nopriv_rookie_ajax_feedback', 'rookie_ajax_feedback' );


/**
    Getting post thumbnail url
 */
function rookie_get_thumb_url($pots_ID){
  return wp_get_attachment_url( get_post_thumbnail_id( $pots_ID ) );
}

/**
    Getting Slider video url
 */
function get_video_ID($link){
  if( empty($link) ) return false;
  $path  =  trim(parse_url($link, PHP_URL_PATH), '/');
  $query_string = parse_url($link, PHP_URL_QUERY);
  parse_str($query_string, $output);
  if( empty($output) ){
    return $path;
  } else {
    return $output['v'];
  }
}

/**
    Show welcome message and tips
*/
  function rookie_welcome_msg() {
    if(!get_option('rookie_welcome_box_displayed')) { update_option('rookie_theme_version',THEME_VERSION); ?>
    <div class="updated">
      <?php include_once(THEME_DIR.'/includes/welcome.php');?>
    </div> 
    <?php
  }
}

/** 
    Show admin notices
*/
  function rookie_check_installation(){
    add_action( 'admin_notices', 'rookie_welcome_msg', 1 );
  }
add_action( 'admin_init', 'rookie_check_installation' );


// Update latest theme version
add_action('wp_ajax_rookie_update_version', 'rookie_update_version');

function rookie_update_version(){
  update_option('rookie_theme_version', THEME_VERSION);
  die();
}

// Update latest theme version
add_action('wp_ajax_rookie_hide_welcome', 'rookie_hide_welcome');

function rookie_hide_welcome(){
  update_option('rookie_welcome_box_displayed', true);
  die();
}


/**
    Load Required Files
**/

// Required rookie functions
require_once THEME_DIR . '/admin/theme-options.php';

// Rookie Styles and Scripts 
require_once THEME_DIR . '/admin/core/scripts.php';

// Rookie Sidebars, widgets and menus
require_once THEME_DIR . '/admin/core/register.php';

// Plugins required
require_once THEME_DIR . '/admin/plugins-setup.php';

// Custom functions
require_once THEME_DIR . '/admin/core/clean.php';
require_once THEME_DIR . '/admin/core/snippets.php';
require_once THEME_DIR . '/admin/core/jetpack.php';

// Bootstrap Style Breadcrumbs
require_once THEME_DIR . '/includes/breadcrumbs.php';

// Bootstrap nav walker
require_once THEME_DIR . '/includes/bootstrap-walker.php';

// Bootstrap Pagination
require_once THEME_DIR . '/includes/bootstrap-pagination.php';

// Custom template tags
require_once THEME_DIR . '/includes/template-tags.php';

// Implement Custom Header features.
require_once THEME_DIR . '/includes/custom-header.php';

// related posts
require_once THEME_DIR . '/loop/content-related-posts.php';
