<?php
/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */
?>

<article class="no-results not-found">
	<header class="entry-header">
		<h2 class="page-title"><?php _e( 'Nothing Found', 'rookie' ); ?></h2>
	</header><!-- .page-header -->

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rookie' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rookie' ); ?></p>
			
			<div class="fff" style="margin-bottom: 3em">
				<?php get_search_form(); ?>
			</div>
		<?php else : ?>

			<p><?php _e( 'It seems we did not find what you are looking for. Perhaps searching can help.', 'rookie' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	
</article><!-- .no-results -->
