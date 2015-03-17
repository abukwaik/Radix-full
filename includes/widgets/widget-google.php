<?php 

/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */


class rookie_google_widget extends WP_Widget {

	function rookie_google_widget() {
		$widget_ops = array( 'classname' => 'google-widget'  );
		$control_ops = array( 'width' => 200, 'height' => 300, 'id_base' => 'google-widget' );
		$this->WP_Widget( 'google-widget', THEME_NAME .' Google+ page', $widget_ops, $control_ops );
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
		<div class="google-box">
			<div class="g-page" data-width="200" data-href="<?php echo $page_url ?>" data-rel="publisher"></div>
			<script type="text/javascript">
				(function() {
					var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
					po.src = 'https://apis.google.com/js/platform.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
				})();
			</script>		
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
		$defaults = array( 'title' =>__( 'Follow us on Google+' , 'rookie') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if( !empty($instance['title']) ) echo $instance['title']; ?>" class="widefat" type="text" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'page_url' ); ?>">Page Url : </label>
			<input id="<?php echo $this->get_field_id( 'page_url' ); ?>" name="<?php echo $this->get_field_name( 'page_url' ); ?>" value="<?php if( !empty($instance['page_url']) ) echo $instance['page_url']; ?>" class="widefat" type="text" />
		</p>


		<?php
	}
}

function reg_google_widget_box() {
	register_widget( 'rookie_google_widget' );
}

add_action( 'widgets_init', 'reg_google_widget_box' );