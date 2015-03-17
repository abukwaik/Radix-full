<?php
/**
 * The Template for displaying all single portfolio.
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */

get_header(); ?>
<div class="row-fluid">
	<div id="primary" class="content-area col-md-12">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'loop/content', 'portfolio', get_post_format() ); ?>
			<?php setPostViews(get_the_ID()); ?>
			<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
			?>
			<?php if (ro_get_option('post_navigation')) { ?>
			<?php rookie_content_nav( 'nav-below' ); ?>
			<?php } ?>
		<?php endwhile; // end of the loop. ?>
	</div>
</div> <!-- row-fluid -->
<?php get_footer(); ?>