<?php 

/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */

class Rookie_RecentComments extends WP_Widget {
    
    function Rookie_RecentComments() {
        $widget_ops = array('classname' => 'rookie-comments','description' => __( "Rookie Recent Comments" ,'rookie') );
        $this->WP_Widget('Rookie-comments', __('Rookie Recent Comments','rookie'), $widget_ops);
    }

    function widget($args , $instance) {
        extract($args);
        $title = ($instance['title']) ? $instance['title'] : __('' , 'rookie');
        $limit = ($instance['limit']) ? $instance['limit'] : 3;
       
        echo $before_widget;
        if ($title) {
            echo $before_title . $title . $after_title;
        }

        ?>
        <div class="recent-comments-wrapper">
            <?php $args = array(
              'status' => 'approve' ,
              'orderby' => 'comment_date_gmt',
              'order' => 'DESC',
              'count' => false ,
              'number'=> $limit
              );

            $comments = get_comments($args);
            foreach($comments as $comment) { ?>
                <div class="recents clearfix">
                    <div class="pull-left">
                        <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_title( $comment->comment_post_ID ) ?>" class="avatar"><?php echo get_avatar( $comment->comment_author_email, '50' ); ?></a>
                    </div>
                    <div class="recents-body">
                        <span class="recents-heading">
                            <strong><?php echo get_comment_author( $comment->comment_ID ); ?>: </strong> <span><?php echo wp_trim_words( $comment->comment_content, '6' ); ?></span>
                        </span>
                        <small>
                            <span><a href="<?php echo get_permalink( $comment->comment_post_ID ) . '#comment-' . $comment->comment_ID; ?>" title="<?php echo get_the_title( $comment->comment_post_ID ) ?>"><?php echo __( 'view comment', 'rookie' ); ?> &rarr;</a></span>
                        </small>
                    </div>
                </div>
            <?php } ?>
        </div> <!-- end comments wrapper -->
    
        <?php
        echo $after_widget;
    }

    function form($instance) {
        if(!isset($instance['title'])) $instance['title'] = __('Recent Comments' , 'rookie');
        if(!isset($instance['limit'])) $instance['limit'] = 3;

        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title ','rookie') ?></label><br>
            <input type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>"
            name="<?php echo $this->get_field_name('title'); ?>"
            id="<?php $this->get_field_id('title'); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit Posts Number ','rookie') ?></label><br>    
            <input type="text" class="widefat" value="<?php echo esc_attr($instance['limit']); ?>"
            name="<?php echo $this->get_field_name('limit'); ?>"
            id="<?php $this->get_field_id('limit'); ?>" />
        </p>


        <?php
    }

}


function reg_recent_comments() {
    register_widget('Rookie_RecentComments');
}

add_action('widgets_init' , 'reg_recent_comments');