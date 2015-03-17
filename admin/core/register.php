<?php
/**
 *
 * Register Menus, Sidebars, Footer widgets
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 */

/**
    Menus & Navigation
**/

// Primary menu
function desktop_nav() {
  wp_nav_menu(
    array(
      'menu'              => 'Primary',
      'theme_location'    => 'primary',
      'container'         => false,
      'menu_class'        => 'nav navbar-nav navbar-right',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker()
      ) 
    );
}

// Mobile menu
function mobile_nav() {
  wp_nav_menu(
    array(
      'menu'              => 'Primary',
      'theme_location'    => 'primary',
      'container'         => false,
      'menu_class'        => 'nav navbar-nav',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_mobile_navwalker()
      ) 
    );
}

// Footer menu
function footer_nav() {
  wp_nav_menu(
    array(
      'menu'              => 'Footer Menu',
      'theme_location'    => 'footer-menu',
      'container'         => false,
      'menu_class'        => 'unstyled',
      'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
      'walker'            => new wp_bootstrap_navwalker()
      ) 
    );
}
/**
    Add search box to Navigation menu
**/
function add_search_box($items, $args) {
    if($args->theme_location == 'primary' && ro_get_option('navbar_search') ) {
        $searchlink = '
        <li id="search_dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-search"></i></a>                 
          <ul id="dropdown_animation" class="dropdown-menu">
            <li>
              <form class="navbar-form" role="search" action="'. get_home_url( '/' ). '">     
                <div class="input-group">
                  <input type="text" name="s" id="nav-search" class="search-pop form-control" value="" placeholder="Search"/>
                  <span class="input-group-btn">
                    <button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </form>
            </li>
          </ul>
        </li>';
        $items .= $searchlink;
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_box', 10, 2);


/**
    Register widgetized area and update sidebar with default widgets
**/

function rookie_widgets_init() {

  // add sidebars
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'rookie' ),
    'id'            => 'sidebar',
    'description'   => __('The default sidebar, place widgets here will show in all posts','rookie'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
   ) );
  register_sidebar( array(
    'name'          => __( 'Pages Sidebar', 'rookie' ),
    'id'            => 'sidebar-2',
    'description'   => __('The second sidebar, place widgets here will show in all pages','rookie'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
   ) ); 

  // add footer widgets
  switch (ro_get_option('footer_col')) {
    case '1':
    register_sidebar(array(
     'name'          => __( 'Footer Widget 1', 'rookie' ),
     'id'            => 'footer-widget-1',
     'description'   => __('The first Row of Footer Widgets, place widgets as per no. of footer widgets setting you set in Theme Options','rookie'),
     'before_widget' => '<article class="footer-widgets col-md-12 %2$s" id="%1$s">',
     'after_widget'  => '</article>',
     'before_title'  => '<h3 class="footer-widget-title">',
     'after_title'   => '</h3>',
     ) );
    break;

    case '2':
    register_sidebar(array(
     'name'          => __( 'Footer Widget 1', 'rookie' ),
     'id'            => 'footer-widget-1',
     'description'   => __('The first Row of Footer Widgets, place widgets as per no. of footer widgets setting you set in Theme Options','rookie'),
     'before_widget' => '<article class="footer-widgets col-md-6 %2$s" id="%1$s">',
     'after_widget'  => '</article>',
     'before_title'  => '<h3 class="footer-widget-title">',
     'after_title'   => '</h3>',
     ) );
    break;

    case '3':
    register_sidebar(array(
     'name'          => __( 'Footer Widget 1', 'rookie' ),
     'id'            => 'footer-widget-1',
     'description'   => __('The first Row of Footer Widgets, place widgets as per no. of footer widgets setting you set in Theme Options','rookie'),
     'before_widget' => '<article class="footer-widgets col-md-4 %2$s" id="%1$s">',
     'after_widget'  => '</article>',
     'before_title'  => '<h3 class="footer-widget-title">',
     'after_title'   => '</h3>',
     ) );
    break;

    case '4':
    register_sidebar(array(
     'name'          => __( 'Footer Widget 1', 'rookie' ),
     'id'            => 'footer-widget-1',
     'description'   => __('The first Row of Footer Widgets, place widgets as per no. of footer widgets setting you set in Theme Options','rookie'),
     'before_widget' => '<article class="footer-widgets col-md-3 %2$s" id="%1$s">',
     'after_widget'  => '</article>',
     'before_title'  => '<h3 class="footer-widget-title">',
     'after_title'   => '</h3>',
     ) );
    break;
  }

}

add_action( 'widgets_init', 'rookie_widgets_init' );


/**
    Theme Widgets
**/

require_once THEME_DIR . '/includes/widgets/widget-twitter.php';
require_once THEME_DIR . '/includes/widgets/widget-recent-posts.php';
require_once THEME_DIR . '/includes/widgets/widget-flickr.php';
require_once THEME_DIR . '/includes/widgets/widget-recent-comments.php';
require_once THEME_DIR . '/includes/widgets/widget-facebook.php';
require_once THEME_DIR . '/includes/widgets/widget-google.php';
require_once THEME_DIR . '/includes/widgets/widget-ads-small.php';
require_once THEME_DIR . '/includes/widgets/widget-ads-big.php';
require_once THEME_DIR . '/includes/widgets/widget-youtube.php';

