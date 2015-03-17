<?php
/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */
?>

<div class="author-box clearfix">
	<div class="author-box-info">
		<div class="col-sm-2 author-avatar">
			<?php echo get_avatar(get_the_author_meta('ID') , '90'); ?>
		</div>
		<div class="col-sm-10 author-description">
			<h3 class="author-name">
			<?php the_author_posts_link(); ?>
			</h3>
			<p><?php echo get_the_author_meta('description'); ?></p>
			<?php if (ro_get_option('author_socials')) { ?>
			<div class="author-socials">
				<?php author_socials(); ?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>