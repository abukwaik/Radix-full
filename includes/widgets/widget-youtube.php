<?php 

/**
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */

class rookie_youtube_widget extends WP_Widget {

	function rookie_youtube_widget() {
		$widget_ops = array( 'classname' => 'youtube-widget'  );
		$control_ops = array( 'width' => 200, 'height' => 300, 'id_base' => 'youtube-widget' );
		$this->WP_Widget( 'youtube-widget',THEME_NAME .' YouTube Channel', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$page_url = $instance['page_url'];

		echo $before_widget;
		if ( $title )
			echo $before_title;
			echo $title ; ?>
		<?php echo $after_title; ?>
		<div class="youtube-box">
			<iframe id="fr" src="http://www.youtube.com/subscribe_widget?p=<?php echo $page_url ?>" style="overflow: hidden; height: 105px; border: 0; width: 100%;" scrolling="no" frameBorder="0"></iframe>
		</div>
	<?php 
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_url'] = strip_tags( $new_instance['page_url'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' =>__( 'Subscribe to our Channel' , 'rookie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty( $instance['title'] ) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Channel Name : </label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( !empty( $instance['page_url'] ) ) echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>


	<?php
	}
}



function reg_youtube_widget_box() {
	register_widget( 'rookie_youtube_widget' );
}

add_action( 'widgets_init', 'reg_youtube_widget_box' );