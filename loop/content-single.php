<?php
/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
	
	<?php rookie_post_thumbnail(); ?>
	
	<header class="entry-header">
		<h2 class="entry-title" itemprop="headline"><?php the_title(); ?></h2>
		<div class="entry-meta">
			<?php rookie_posted_on(); ?>
		</div>
	</header> <!-- entry-header -->

	<div class="entry-content clearfix">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'rookie' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
				) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'rookie' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'current_before' => '',
				'current_after' => '',
				'pagelink'    => '%',
			) );
		?>
    	<?php if (ro_get_option ('related_posts')) { ?>
    	<?php do_related_posts (); ?>
    	<?php } ?>
    	<?php if (ro_get_option ('post_socials')) { ?>
    	<?php post_socials(); ?> 
    	<?php } ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php rookie_entry_footer(); ?>
	</footer> <!-- entry-footer -->
	
</article>

<?php if (ro_get_option('show_feedback')) { ?>
<?php get_template_part( 'loop/content', 'feedback' ); ?>
<?php } ?>

<?php if (ro_get_option('post_navigation')) { ?>
<?php rookie_content_nav( 'nav-below' ); ?>
<?php } ?>

<?php if(ro_get_option ('blog_author_bio')) { ?>
<?php get_template_part( 'loop/content', 'author' ); ?>
<?php } ?>

<div id="blog-after" class="clearfix">
	<div class="recent-posts-area">
		<div class="col-sm-6">
			<?php if (ro_get_option ('recent_posts')) { ?>
			<?php get_template_part('loop/content', 'recent-posts'); ?>
			<?php } ?>
		</div>
	</div> <!-- end recent posts -->
	<div class="popular-posts-area">
		<div class="col-sm-6">
			<?php if (ro_get_option ('popular_posts')) { ?>
			<?php get_template_part('loop/content', 'popular-posts'); ?>
			<?php } ?>
		</div>
	</div> <!-- end popular posts -->
</div> <!-- blog-after -->