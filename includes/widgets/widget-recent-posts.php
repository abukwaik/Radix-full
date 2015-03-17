<?php 

/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */


class rookie_Recent_Posts_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'rookie_recent_posts', // Base ID
            'Rookie Recent Posts', // Name
            array( 'description' => __( 'Recent Posts Widget', 'rookie' ), ) // Args
            );
    }

    function widget( $args, $instance ) {
        $title  = $instance['title'];
        $count  = $instance['count'];
        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        } ?>

        <div class="recent-posts-wrapper">
            <?php $posts = get_posts( array( 'numberposts' => $count ) );
            foreach ($posts as $key => $value) { ?>
                <div class="recents clearfix">
                    <div class="pull-left">
                        <?php if (has_post_thumbnail( $value->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $value->ID ), 'small-thumb' ); ?>
                            <a href="<?php echo get_permalink( $value->ID ); ?>">
                                <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $value->post_title; ?>" class="img-responsive">
                            </a>
                            <?php else : ?>
                            <a href="<?php echo get_permalink( $value->ID ); ?>">
                                <img class="img-responsive" alt="thumb" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyBAMAAADsEZWCAAAAGFBMVEXe3t4AAABTU1Nvb2+mpqbCwsKKioo3NzdWCpNbAAAAiUlEQVQ4je2PPQqFMBCEh0RzDkHSB3xaW1kviL34e/8bmF2j0fp1kiEk7H7sZBZISvpP+aui8JZVaxobClX9ME8BOaCHCkT7eYfiJgt3Or78MS23TjeqYQhmtOxWa8J6/eiEYBd7/SLihnIUEt08kQSKNiExQTORpB6Q+f5mY2peLG6aPzZN+pYOXLMRI0lTo4MAAAAASUVORK5CYII=">
                            </a>
                        <?php endif;?>
                    </div>
                    <div class="recents-body">
                        <span class="recents-heading"><a href="<?php echo get_permalink( $value->ID ); ?>" title="<?php echo $value->post_title; ?>"><?php echo $value->post_title; ?></a></span>
                        <small><?php _e('Posted', 'rookie'); ?> <?php echo date( 'd F Y', strtotime($value->post_date) ); ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    function form( $instance ) {
        $title  = isset($instance[ 'title' ]) ? $instance[ 'title' ] : 'Recent Posts';
        $count  = isset($instance[ 'count' ]) ? $instance[ 'count' ] : 3; ?>

        <p>
            <label for="<?php echo $this->get_field_name( 'title' ); ?>"><?php _e( 'Title:', 'rookie' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_name( 'count' ); ?>"><?php _e( 'Number of posts:', 'rookie' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo esc_attr( $count ); ?>" />
        </p>
        <?php 
    }

    function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['count'] = ( ! empty( $new_instance['count'] ) ) ? strip_tags( $new_instance['count'] ) : '';
        return $instance;
    }
}


function reg_recent_posts_widget() {
    register_widget( 'rookie_recent_posts_Widget' );
}

add_action( 'widgets_init', 'reg_recent_posts_widget' );