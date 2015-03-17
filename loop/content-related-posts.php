<?php

/**
* Shows related posts by tag if available and category if not
* The code has been modified
*
* @package Rookie
* @author Justin Tallant
* @link https://gist.github.com/jtallant/3670275
* @since rookie 1.0
*
*/


// get related posts
function related_posts($title = 'Related Posts', $count = '' ) {
  global $post;
  $tag_ids = array();
  $current_cat = get_the_category($post->ID);
  $current_cat = $current_cat[0]->cat_ID;
  $this_cat = '';
  $count = ro_get_option( 'related_posts_count', '3' );
  $tags = get_the_tags($post->ID);

  if ( $tags ) {
    foreach($tags as $tag) {
      $tag_ids[] = $tag->term_id;
    }

  } else {
    $this_cat = $current_cat;
  }

  $args = array(
    'post_type' => get_post_type(),
    'numberposts' => $count,
    'orderby' => 'rand',
    'tag__in' => $tag_ids,
    'cat' => $this_cat,
    'exclude' => $post->ID
    );

  $related_posts = get_posts($args);

  /**
  * If the tags are only assigned to this post try getting
  * the posts again without the tag__in arg and set the cat
  * arg to this category.
  */

  if ( empty($related_posts) ) {
    $args['tag__in'] = '';
    $args['cat'] = $current_cat;
    $related_posts = get_posts($args);
  }

  if ( empty($related_posts) ) {
    return;
  }

  $post_list = '';
  foreach($related_posts as $related) {
    $post_list .= '<li><a href="' . get_permalink($related->ID) . '" itemprop="url" title="' . $related->post_title . '"><span itemprop="name">' . $related->post_title . '</span></a></li>';
  }

  return sprintf('
    <div class="related-posts">
      <h4 class="recent-title">%s</h4>
      <ul itemscope itemtype="http://schema.org/Article">%s</ul>
    </div> <!-- .related-posts -->
    ', $title, $post_list );
}

//Customize the title and where the related posts are displayed
add_action('after_post_content', 'related_posts');

function do_related_posts() {
  $title = __('Related Posts' ,'rookie');
  
  if ( !is_single() ) {
    return;
  }

  if ( get_post_type() == 'gallery' || get_post_type() == 'case-studies' ) {
    $title = __('See more' ,'rookie');
  }

  /**
  * Array of post types to be excluded
  */
  $exclude = array('aeprofiles', 'bizdir', 'palettes');
  foreach($exclude as $type) {
    if ( get_post_type() == $type ) {
      return;
    }
  }
  echo related_posts($title); 
}