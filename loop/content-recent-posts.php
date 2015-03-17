<?php
/**
* Popular recent posts ordered by date published
*
* @package Rookie
* @author Abukwaik http://www.croti.com
* @since rookie 1.0
*
*/
?>

<h3 class="recent-title"><?php echo __('Recent Posts', 'rookie'); ?></h3>
<div class="recent-posts-wrapper">
	<?php
	global $post;
	$args = array(
		'numberposts' => 3, 
		'orderby' => 'date'
		);

	$recent_posts = get_posts($args);

	foreach ($recent_posts as $post) :
		setup_postdata($post);
	?>

	<div class="recents clearfix"> 
		<div class="pull-left">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) {
					echo get_the_post_thumbnail( $post->ID, 'small-thumb', array('class' => 'img-responsive'));
				} else { ?>
				<img alt="thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyBAMAAADsEZWCAAAAGFBMVEXe3t4AAABTU1Nvb2+mpqbCwsKKioo3NzdWCpNbAAAAiUlEQVQ4je2PPQqFMBCEh0RzDkHSB3xaW1kviL34e/8bmF2j0fp1kiEk7H7sZBZISvpP+aui8JZVaxobClX9ME8BOaCHCkT7eYfiJgt3Or78MS23TjeqYQhmtOxWa8J6/eiEYBd7/SLihnIUEt08kQSKNiExQTORpB6Q+f5mY2peLG6aPzZN+pYOXLMRI0lTo4MAAAAASUVORK5CYII=">
				<?php } ?>
			</a>
		</div>
		<div class="recents-body">
			<span class="recents-heading">
			<a href="<?php the_permalink(); ?>" title="<?php the_title( ); ?>" itemprop="url"><span itemprop="name"><?php the_title( ); ?></span></a> 
			</span>
			<small><?php the_time( 'F d, Y' ); ?></small> 
		</div>
	</div>

	<?php endforeach;
	wp_reset_postdata();
	wp_reset_query(); ?>
</div>