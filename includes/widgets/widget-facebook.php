<?php 

/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */

class rookie_facebook_widget extends WP_Widget {

    function rookie_facebook_widget() {
        $widget_ops = array( 'classname' => 'facebook-widget' );
        $control_ops = array( 'width' => 200, 'height' => 300, 'id_base' => 'facebook-widget' );
        $this->WP_Widget( 'facebook-widget', THEME_NAME .' Facebook Box', $widget_ops, $control_ops );
    }
    
    function widget( $args, $instance ) {
        extract( $args );

        $color = 'light';
        if( !empty($instance['dark']) ) $color = 'dark';
        $title = apply_filters('widget_title', $instance['title'] );
        $page_url = $instance['page_url'];

        echo $before_widget;
        if ( $title )
            echo $before_title;
        echo $title ; ?>
        <?php echo $after_title; ?>

        <div class="facebook-box">
            <iframe src="http://www.facebook.com/plugins/likebox.php?href=<?php echo $page_url ?>&amp;width=200&amp;height=300&amp;colorscheme=<?php echo $color; ?>&amp;show_faces=true&amp;header=false&amp;stream=false&amp;show_border=true" style="border:0; overflow:hidden; width:200px; height:300px;"></iframe>
        </div>

        <?php 
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['page_url'] = strip_tags( $new_instance['page_url'] );
        $instance['dark'] = strip_tags( $new_instance['dark'] );
        return $instance;
    }

    function form( $instance ) {
        $defaults = array( 'title' =>__( 'Find us on Facebook' , 'rookie') );
        $instance = wp_parse_args( (array) $instance, $defaults ); ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Page Url : </label>
            <input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( !empty($instance['page_url']) ) echo $instance['page_url']; ?>" class="widefat" type="text" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'dark' ); ?>">Dark Skin ?</label>
            <input id="<?php echo $this->get_field_id( 'dark' ); ?>" name="<?php echo $this->get_field_name( 'dark' ); ?>" value="true" <?php if( !empty($instance['dark']) ) echo 'checked="checked"'; ?> type="checkbox" />
        </p>

        <?php
    }

}


function reg_facebook_widget_box() {
    register_widget( 'rookie_facebook_widget' );
}

add_action( 'widgets_init', 'reg_facebook_widget_box' );