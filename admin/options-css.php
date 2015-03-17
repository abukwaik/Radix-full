<?php
/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */

  // Fonts
  $main_font = ro_get_option('main_font');
  $h1_font = ro_get_option('h1_font');
  $h2_font = ro_get_option('h2_font');
  $h3_font = ro_get_option('h3_font');
  $h4_font = ro_get_option('h4_font');
  $h5_font = ro_get_option('h5_font');
  $h6_font = ro_get_option('h6_font');
  $nav_font = ro_get_option('nav_font');

  // Header
  $color_header_txt = ro_get_option('color_header_txt');
  $color_header_bg = ro_hex2rgba(ro_get_option('color_header_bg'),ro_get_option('header_bg_opacity'));
  $color_header_socials = ro_hex2rgba(ro_get_option('color_header_socials'), 0.9);
  $a_color_header_txt = ro_get_option('a_color_header_txt');
  $a_color_header_hov = ro_get_option('a_color_header_hov');
  $header_bg_img = ro_get_option_media('header_bg_img');
  $header_bg_style = ro_get_option('header_bg_style');

  // Sub Header
  $sub_header_bg_img = ro_get_option_media('sub_header_bg_img');
  $sub_header_bg_color = ro_hex2rgba(ro_get_option('sub_header_bg_color'));
  $color_sub_header_txt = ro_get_option('color_sub_header_txt');
  $color_breadcrumbs_txt_a = ro_get_option('color_breadcrumbs_txt_a');
  $color_breadcrumbs_txt_a_hover = ro_get_option('color_breadcrumbs_txt_a_hover');

  //Body
  $color_a_text = ro_get_option('color_a_text');
  $color_a_hov = ro_get_option('color_a_hov');

  $color_body_boxed_bg = ro_get_option('color_body_boxed_bg');
  $body_bg_img = ro_get_option_media('body_bg_img');
  $body_bg_style = ro_get_option('body_bg_style');

  //Content
  $color_content_bg = ro_get_option('color_content_bg');
  $color_content_txt_h = ro_get_option('color_content_txt_h');
  $color_content_txt = ro_get_option('color_content_txt');
  $color_content_meta = ro_get_option('color_content_meta');

  $author_bg_color = ro_get_option('author_bg_color');
  $author_txt_color = ro_get_option('author_txt_color');

  //Sidebar
  $color_sidebar_bg = ro_get_option('color_sidebar_bg');
  $color_sidebar_txt_h = ro_get_option('color_sidebar_txt_h');
  $color_sidebar_txt = ro_get_option('color_sidebar_txt');
  $color_sidebar_txt_hov = ro_get_option('color_sidebar_txt_hov');

  //Footer
  $color_footer_bg = ro_get_option('color_footer_bg');
  $color_footer_txt_h = ro_get_option('color_footer_txt_h');
  $color_footer_txt = ro_get_option('color_footer_txt');
  $color_footer_txt_hov = ro_get_option('color_footer_txt_hov');

?>


<?php // Header Area //////////////////////////////////////////// ?>

#top-bar {
  <?php if(!empty($header_bg_img)): ?>
  background: url('<?php echo esc_url($header_bg_img); ?>') <?php echo $header_bg_style; ?>;
  <?php else: ?>
  background-color: <?php echo $color_header_bg; ?>;
  <?php endif; ?>
  color : <?php echo $color_header_txt; ?>;
}

#top-bar-social a {
  color: <?php echo $color_header_socials; ?>;
}

.external-link a {
  color: <?php echo $a_color_header_txt; ?>;
}

.external-link a:hover {
  color: <?php echo $a_color_header_hov; ?>;
}

#sub-header {
  <?php if(!empty($sub_header_bg_img)): ?>
  background-image: url('<?php echo esc_url($sub_header_bg_img); ?>');
  background-size: cover; 
  background-repeat: no-repeat; 
  background-position: 50% 0px; 
  background-attachment: fixed; 
  min-height: auto;
  <?php else: ?>
  background-color: <?php echo $sub_header_bg_color; ?>;
  <?php endif; ?>
  color : <?php echo $color_sub_header_txt; ?>;
}

#breadcrumbs a {
  color: <?php echo $color_breadcrumbs_txt_a; ?>
}
#breadcrumbs a:hover {
  color: <?php echo $color_breadcrumbs_txt_a_hover; ?>
}

<?php // Body Area ////////////////////////////////////////////// ?>

body {

  <?php if(!empty($body_bg_img)): ?>
  background-image: url('<?php echo esc_url($body_bg_img); ?>');
  background-repeat: <?php echo $body_bg_style['background-repeat']; ?>;
  background-size: <?php echo $body_bg_style['background-size']; ?>;
  background-attachment: <?php echo $body_bg_style['background-attachment']; ?>;
  background-position: <?php echo $body_bg_style['background-position']; ?>;
  <?php else: ?>
  background-color: <?php echo $body_bg_style['background-color']; ?>;
  <?php endif; ?>
  color: <?php echo $main_font['color']; ?>;
  font-family: <?php echo $main_font['font-family']; ?>;
  font-weight: <?php echo $main_font['font-weight']; ?>;
  font-size: <?php echo $main_font['font-size']; ?>;
}

a {
  color: <?php echo $color_a_text; ?>;
}

a:hover, a:active, a:focus {
  color: <?php echo $color_a_hov; ?>;
  text-decoration: none;
  -webkit-transition: all .3s;
  transition: all .3s
}


<?php // Content Area ////////////////////////////////////////////// ?>

.hentry {
  background-color: <?php echo $color_content_bg; ?>;
}

.entry-title {
  color: <?php echo $color_content_txt_h; ?>;
}

.entry-footer, .entry-meta {
  color: <?php echo $color_content_meta; ?>;
}

.author-box {
  background: <?php echo $author_bg_color; ?>;
  color: <?php echo $author_txt_color; ?>;
}  


<?php // Sidebar Area ////////////////////////////////////////////// ?>

#sidebar .sidebar-padder {
  background-color: <?php echo $color_sidebar_bg; ?>;
}

.widget-title {
  color: <?php echo $color_sidebar_txt_h; ?>;
}

#sidebar a {
  color: <?php echo $color_sidebar_txt; ?>;
}

#sidebar a:hover, a:active, a:focus {
  color: <?php echo $color_sidebar_txt_hov; ?>;
}


<?php // Footer Area ////////////////////////////////////////////// ?>

.footer-wrapper {
  background-color: <?php echo $color_footer_bg; ?>;
}

.footer-widget-title {
  color: <?php echo $color_footer_txt_h; ?>;
}

.footer-wrapper a {
  color: <?php echo $color_footer_txt; ?>;
}

.footer-wrapper a:hover, a:active, a:focus {
  color: <?php echo $color_footer_txt_hov; ?>;
}


<?php // Typography Area ////////////////////////////////////////////// ?>

h1, .h1 {
  font-size: <?php echo $h1_font['font-size']; ?>;
  font-family: <?php echo $h1_font['font-family']; ?>;
  font-weight: <?php echo $h1_font['font-weight']; ?>;
}

h2, .h2 {
  font-size: <?php echo $h2_font['font-size']; ?>;
  font-family: <?php echo $h2_font['font-family']; ?>;
  font-weight: <?php echo $h2_font['font-weight']; ?>;
}

h3, .h3 {
  font-size: <?php echo $h3_font['font-size']; ?>;
  font-family: <?php echo $h3_font['font-family']; ?>;
  font-weight: <?php echo $h3_font['font-weight']; ?>;
}

h4, .h4 {
  font-size: <?php echo $h4_font['font-size']; ?>;
  font-family: <?php echo $h4_font['font-family']; ?>;
  font-weight: <?php echo $h4_font['font-weight']; ?>;
}

h5, .h5 {
  font-size: <?php echo $h5_font['font-size']; ?>;
  font-family: <?php echo $h5_font['font-family']; ?>;
  font-weight: <?php echo $h5_font['font-weight']; ?>;
}

h6, .h6 {
  font-size: <?php echo $h6_font['font-size']; ?>;
  font-family: <?php echo $h6_font['font-family']; ?>;
  font-weight: <?php echo $h6_font['font-weight']; ?>;
}

.navbar-default {
  font-family: <?php echo $nav_font['font-family']; ?>;
  font-weight: <?php echo $nav_font['font-weight']; ?>;
  font-size: <?php echo $nav_font['font-size']; ?>;
}
