<?php
/**
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script>
    var cb = function() {
    var l = document.createElement('link'); l.rel = 'stylesheet';
    l.href = '<?php echo CSS_URI ?>/all.min.css';
    var h = document.getElementsByTagName('head')[0]; h.parentNode.insertBefore(l, h);};
    var raf = requestAnimationFrame || mozRequestAnimationFrame ||
    webkitRequestAnimationFrame || msRequestAnimationFrame;
    if (raf) raf(cb);
    else window.addEventListener('load', cb);
</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php $logo_url = ro_get_option('logo_custom_url') ? ro_get_option('logo_custom_url') : home_url( '/' ); $logo = ro_get_option('logo') ?>
<?php if (ro_get_option('sticky_header')) { ?>
<header id="header-wrap" itemscope="itemscope" itemtype="http://schema.org/Organization" role="banner">
<?php } ?> 
    <?php if (ro_get_option('hide_top_header')) { ?>
    <?php get_template_part( 'loop/top-header' ); ?>
    <?php } ?>
    <div id="site-nav" class="navbar navbar-default navbar-main">
        <div class="container clearfix">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"><?php _e('Toggle navigation', 'rookie'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div id="navbar-brand">
                    <div class="logo">
                        <?php $logo_width = ro_get_option( 'logo_width', '110' ); $logo_height = ro_get_option( 'logo_height', '30' ); ?>        
                        <?php if(!empty($logo['url'])) : ?>
                            <a itemprop="url" href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" >
                                <img itemprop="logo" width="<?php echo $logo_width; ?>" height="<?php echo $logo_height; ?>" src="<?php echo $logo['url']; ?>" alt="<?php bloginfo( 'name' ); ?>" />
                            </a>                    
                        <?php else: ?>
                            <h2 class="site-title" itemprop="headline"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
                            <?php if (ro_get_option('header_description')) { ?>                              
                            <p class="site-desc" itemprop="description"><?php echo get_bloginfo('description'); ?></p>
                            <?php } ?>
                        <?php endif; ?>
                    </div> <!-- Logo -->
                </div> <!-- navbar-brand -->
            </div> <!-- navbar-header -->
            <?php if ( wp_is_mobile() ) : ?>
                <nav id="mobile-menu" class="visible-xs" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                    <div class="collapse navbar-collapse">
                        <?php mobile_nav(); ?>
                    </div>
                </nav> <!-- mobile-menu -->
            <?php else: ?>
                <nav id="desktop-menu" class="hidden-xs" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                    <?php desktop_nav(); ?>
                </nav> <!-- desktop-menu -->
            <?php endif; ?>
        </div>  <!-- navbar navbar-default -->
    </div> <!-- container -->
</header>  <!-- wrap -->
<?php if( !is_front_page()) { ?>
<?php get_template_part( 'loop/sub-header'); ?>
    <main id="content" class="site-content"> 
        <div class="main-content-area">
            <div class="container-fluid clearfix">

<?php } ?>