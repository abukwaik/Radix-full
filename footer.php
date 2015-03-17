<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 */
?>
<?php if( !is_front_page()) { ?>
        </div> <!-- container -->
    </div><!--/.main-content-area-->
</main><!--/#content-->
<?php } ?>

<?php if(ro_get_option('footer_display')) : ?>
    <footer class="footer-wrapper">
        <div class="container-fluid clearfix">  
            <div class="footer-content">
                <?php dynamic_sidebar('footer-widget-1'); ?>
            </div>
        </div> 
    </footer>
<?php endif; ?>
<?php if(ro_get_option('enable_footer_social')) : ?>
    <?php footer_socials(); ?>
<?php endif; ?>
<?php if(ro_get_option('enable_copyright')) : ?>
    <footer class="footer-bottom-wrapper" itemtype="http://schema.org/WPFooter" itemscope="itemscope" role="contentinfo">
        <div class="container-fluid clearfix">
            <div class="row-fluid">         
                <div class="copyright-text col-md-6">
                    <?php _e( 'Copyright &copy; ', 'rookie' ); ?>
                    <span itemprop="copyrightYear">
                        <?php echo date( 'Y' ); ?>
                    </span>
                    <a href="<?php echo home_url() ?>" itemprop="url"><span itemprop="copyrightHolder"><?php echo esc_attr( get_bloginfo( 'name' ) ); ?></span></a>
                    <?php _e( 'All rights reserved.', 'rookie' ); ?>
                </div> 
                <nav class="footer-nav col-md-6" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement" role="navigation">
                    <?php if (has_nav_menu('footer-menu') && ro_get_option('enable_footer_menu')) : ?>
                        <?php footer_nav(); ?>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </footer>
<?php endif; ?>
<?php if(ro_get_option('scroll_to_top')): ?>
    <a href="#" class="to-top"><i class="fa fa-arrow-up"></i></a>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>