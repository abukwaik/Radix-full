<?php 

/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */

class Rookie_Twitter extends WP_Widget {
  
  function Rookie_Twitter(){

    $widget_ops = array('classname' => 'rookie-twitter','description' => __( "Rookie Twitter Widget" ,'rookie') );
    $this->WP_Widget('Rookie-twitter', __('Rookie Twitter Widget','rookie'), $widget_ops);
  }

  function widget($args , $instance) {
    extract($args);
    $title = ($instance['title']) ? $instance['title'] : __('Twitter' , 'rookie');
    $limit = ($instance['limit']) ? $instance['limit'] : 3;
    $twitter_id = ($instance['twitter_id']) ? $instance['twitter_id'] : '';
    $enable_twitter_id_link = '';
    if(isset($instance['enable_twitter_id_link']))
      $enable_twitter_id_link = $instance['enable_twitter_id_link'] ? $instance['enable_twitter_id_link'] : 'checked';
    echo $before_widget;
    if($title) {
      echo $before_title . $title . $after_title;
    }

    ?>

    <div class="twitter-container">                                    
      <?php 
        if($enable_twitter_id_link != '') {
          ro_twitter($limit , $twitter_id , 'true');
        } else {
          ro_twitter($limit , $twitter_id , 'false');
        } ?>
    </div>    

    <?php echo $after_widget; 
  }

  function form($instance) {
    if(!isset($instance['title'])) $instance['title'] = __('Twitter' , 'rookie');
    if(!isset($instance['limit'])) $instance['limit'] = 3;
    if(!isset($instance['twitter_id'])) $instance['twitter_id'] = '';
    if(!isset($instance['enable_twitter_id_link'])) $instance['enable_twitter_id_link'] = '';

    ?>

    <div class="widget-content">
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title ','rookie') ?></label><br>
        <input type="text" class= "widefat" value= "<?php echo esc_attr($instance['title']); ?>"
        name= "<?php echo $this->get_field_name('title'); ?>" id="<?php $this->get_field_id('title'); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID','rookie') ?></label><br>
        <input type= "text" class= "widefat" value= "<?php echo esc_attr($instance['twitter_id']); ?>"
        name="<?php echo $this->get_field_name('twitter_id'); ?>" id= "<?php $this->get_field_id('twitter_id'); ?>" />
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e('Limit Tweets','rookie') ?></label><br>
        <input type="text" class= "widefat" value="<?php echo esc_attr($instance['limit']); ?>"
        name="<?php echo $this->get_field_name('limit'); ?>" id="<?php $this->get_field_id('limit'); ?>" />
      </p>
      <p>
        <label style="width:100px;">
          <input type="checkbox" class= "widefat" name="<?php echo $this->get_field_name('enable_twitter_id_link'); ?>"
          id= "<?php $this->get_field_id('enable_twitter_id_link'); ?>" <?php if($instance['enable_twitter_id_link'] != '') echo 'checked=checked '; ?> />
          <?php _e('Enable Twitter User Link','rookie') ?>
        </label>
      </p>
    </div>

    <?php
  }

}


function reg_twitter_widget() {
	register_widget('Rookie_Twitter');
}

add_action('widgets_init' , 'reg_twitter_widget');

