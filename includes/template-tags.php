<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 */


if ( ! function_exists( 'rookie_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 * @since 1.0
 */
function rookie_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
	<nav class="comment-navigation" role="navigation">
		<ul class="pager">
			<?php
			if ( $prev_link = get_previous_comments_link( __( '<i class="fa fa-chevron-left fa-fw"></i> Older Comments', 'rookie' ) ) ) :
				printf( '<li class="nav-previous previous">%s</li>', $prev_link );
			endif;

			if ( $next_link = get_next_comments_link( __( 'Newer Comments <i class="fa fa-chevron-right fa-fw"></i>', 'rookie' ) ) ) :
				printf( '<li class="nav-next next">%s</li>', $next_link );
			endif;
			?>
		</ul><!-- .nav-links -->
	</nav><!-- end .navigation -->
	<?php
	endif;
}
endif; // rookie_comment_nav


if ( ! function_exists( 'rookie_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since 1.0
 */
function rookie_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>" role="navigation">
		<ul class="pager">

			<?php if ( is_single() ) : // navigation links for single posts ?>

				<?php previous_post_link( '<li class="nav-previous previous">%link</li>', '<span class="meta-nav">' . __( '<i class="fa fa-chevron-left"></i>', 'Previous post link', 'rookie' ) . '</span> %title' ); ?>
				<?php next_post_link( '<li class="nav-next next">%link</li>', '%title <span class="meta-nav">' . __( '<i class="fa fa-chevron-right"></i>', 'Next post link', 'rookie' ) . '</span>' ); ?>

			<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

				<?php if ( get_next_posts_link() ) : ?>
					<li class="nav-previous previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'rookie' ) ); ?></li>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
					<li class="nav-next next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'rookie' ) ); ?></li>
				<?php endif; ?>

			<?php endif; ?>

		</ul>
	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // rookie_content_nav


if ( ! function_exists( 'rookie_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0
 */
function rookie_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<h3 class="screen-reader-text"><?php _e( 'Post navigation', 'rookie' ); ?></h3>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _e( '<i class="fa fa-chevron-left"></i> %title', 'Previous post link', 'rookie' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _e( '%title <i class="fa fa-chevron-right"></i>', 'Next post link',     'rookie' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif; // rookie_post_nav


if ( ! function_exists( 'rookie_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * 
 * @since 1.0
 */
function rookie_posted_on() {

	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post"><i class="fa fa-star"></i> %s </span>', __( 'Featured', 'rookie' ) );
	} ?>
	<?php edit_post_link( __( 'Edit', 'rookie' ), '<span class="edit-link pull-right">', ' <i class="fa fa-pencil"></i></span>' ); ?>
	<?php

	$time_string = '<time class="entry-date published" itemprop="datePublished" datetime="%1$s">%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	$time_string = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		$time_string
	);

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ){
		$time_string_update = '<time class="updated" datetime="%1$s">%2$s</time>';
		$time_string_update = sprintf( $time_string_update,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$time_string_update = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			$time_string_update
		);
		$time_string .= __(', <span class="updated-on"><i class="fa fa-refresh"></i> updated on</span>', 'rookie') . $time_string_update;
	}

	printf( __( '<span class="posted-on"><i class="fa fa-calendar"></i> Posted %1$s </span><span class="byline" itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author"> by <i class="fa fa-user"></i> %2$s </span>', 'rookie' ),
		$time_string,
		sprintf( '<span class="author vcard"><a class="url fn" rel="author" href="%1$s" title="%2$s" itemprop="url"><span itemprop="name"> %3$s </span></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'rookie' ), get_the_author() ) ),
			esc_html( get_the_author() )
		)
	);
}
endif; // rookie_posted_on



if ( ! function_exists( 'rookie_entry_footer' ) ) :
/**
 * Prints entry footer information for the current post-date/time and author.
 *
 * @package From Twenty Fifteen 1.0
 * @since 1.0
 */
function rookie_entry_footer() {

	if ( 'post' == get_post_type() ) {

		$categories_list = get_the_category_list( __( ', ', 'rookie' ) );
		if ( $categories_list ) { ?>
			<span class="cat-links">
				<i class="fa fa-folder-open" title="<?php __( 'Categories', 'rookie' ); ?>"></i>
				<?php printf( __( 'Categories %1$s ', 'rookie' ), $categories_list ); ?>
			</span>
		<?php } 

		$tags_list = get_the_tag_list( '', __( ', ', 'rookie' ) );
		if ( $tags_list ) { ?>
			<span class="tags-links">
				<i class="fa fa-tags" title="<?php __( 'Tags', 'rookie' ); ?>"></i>
				<?php printf( __( 'Tagged in %1$s ', 'rookie' ), $tags_list ); ?>
			</span>
		<?php }

		if (ro_get_option ('post_views')) { ?>
			<span class="post-views" itemprop="interactionCount"><i class="fa fa-eye"></i>
				<?php echo getPostViews(get_the_ID()); ?>
			</span>
		<?php }

	} // get_post_type

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
		<span class="comments-link" itemprop="interactionCount"><i class="fa fa-comment"></i>
			<?php comments_popup_link( __( 'Leave a comment ', 'rookie' ), __( '1 Comment', 'rookie' ), __( '% Comments ', 'rookie' ) ); ?>
		</span>
	<?php }
}
endif; // rookie_entry_footer


if ( ! function_exists( 'rookie_link_format_helper' ) ) :
/**
 * Returns the first post link and/or post content without the link.
 * Used for the "Link" post format.
 *
 * @since 1.0
 */
function rookie_link_format_helper( $output = false ) {

	if ( ! $output )
		_doing_it_wrong( __FUNCTION__, __( 'You must specify the output you want - either "link" or "post_content".', 'rookie' ), '1.0.1' );

	$post_content = get_the_content();
	$link_start = stristr( $post_content, "http" );
	$link_end = stristr( $link_start, "\n" );

	if ( ! strlen( $link_end ) == 0 ) {
		$link_url = substr( $link_start, 0, -( strlen( $link_end ) + 1 ) );
	} else {
		$link_url = $link_start;
	}

	$post_content = substr( $post_content, strlen( $link_url ) );

	// Return the first link in the post content
	if ( 'link' == $output )
		return $link_url;

	// Return the post content without the first link
	if ( 'post_content' == $output )
		return $post_content;
}
endif; // rookie_link_format_helper


if ( ! function_exists( 'rookie_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since 1.0
 */
function rookie_the_attached_image() {
	$post = get_post();
	/**
	 * Filter the default attachment size.
	 *
	 * @since rookie 1.0
	 *
	 * @param array $dimensions {
	 *     An array of height and width dimensions.
	 *
	 *     @type int $height Height of the image in pixels. Default 810.
	 *     @type int $width  Width of the image in pixels. Default 810.
	 * }
	 */
	$attachment_size     = apply_filters( 'rookie_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}
		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif; // rookie_the_attached_image


/**
 * Determine whether blog/site has more than one category.
 * 
 * @package From Twenty Fifteen 1.0
 * @since rookie 1.0
 */
function rookie_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'rookie_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'rookie_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so rookie_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so rookie_categorized_blog should return false.
		return false;
	}
}


if ( ! function_exists( 'rookie_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * @package From Twenty Fifteen 1.0
 * @since rookie 1.0
 */
function rookie_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<?php 
	$full_img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full-size');
	$img_src= $full_img[0];
	?>
	<div class="post-thumbnail" itemscope="itemscope" itemtype='http://schema.org/ImageObject'>
	  <a href="<?php echo $img_src; ?>" itemprop="image" title="<?php the_title_attribute(); ?>">
	    <?php the_post_thumbnail( 'rookie-featured', array( 'class' => 'single-featured', 'itemprop' => 'thumbnailUrl' )); ?>
	  </a>
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'class' => 'single-featured','itemprop' => 'thumbnailUrl' , 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif; // rookie_post_thumbnail


/**
 * Flush out the transients used in rookie_categorized_blog.
 */
function rookie_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'rookie_category_transient_flusher' );
add_action( 'save_post',     'rookie_category_transient_flusher' );
