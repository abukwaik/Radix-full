<?php 

/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */

class Rookie_Ads_Big extends WP_Widget {

  function Rookie_Ads_Big() {
    $widget_ops = array('classname' => 'rookie-ads-big','description' => __( "Rookie Ads Big" ,'rookie') );
    $this->WP_Widget('Rookie-ads-big', __('Rookie Ads Big','rookie'), $widget_ops);

    // add image js 
    add_action('admin_enqueue_scripts' , array(&$this , 'admin_js') , 99 , 1);
  }

  function widget($args , $instance) {
    extract($args);
    $title = ($instance['title']) ? $instance['title'] : __( '' , 'rookie');
    $url3 = ($instance['url3']) ? $instance['url3'] : '#';
    $href3 = ($instance['href3']) ? $instance['href3'] : 'http://dummyimage.com/195x195/644c80/ffffff.png';

    echo $before_widget;
    if($title) {
      echo $before_title . $title . $after_title;
    }

    ?>

    <div class="ads-container clearfix">
      <div class="ads-lg">
        <div class="col-xs-12">
          <?php if(isset($url3) && $url3 != '') {
            echo '<a class="ads-widget-wrapper" href="'.$url3.'"><img src="'.$href3.'" alt="'.$title.'" /></a>';
          } ?>
        </div>
      </div>
    </div>

    <?php echo $after_widget;
  }

  function form($instance) {
    if(!isset($instance['title'])) $instance['title'] = __('Advertisement' , 'rookie');
    if(!isset($instance['url3'])) $instance['url3'] = '#';
    if(!isset($instance['href3'])) $instance['href3'] = '';

    ?>

    <div class="widget-content">
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ','rookie') ?></label>
        <br>
        <input type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" id="<?php $this->get_field_id('title'); ?>" />
      </p>

      <p>
        <label for="<?php echo $this->get_field_id('url3'); ?>"><?php _e('Link: ','rookie') ?></label>
        <br>
        <input type="text" class="widefat" value="<?php echo esc_attr($instance['url3']); ?>"
        name="<?php echo $this->get_field_name('url3'); ?>" id="<?php $this->get_field_id('url3'); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('img3'); ?>"> <?php _e('Image Url:', 'rookie') ?></label>
        <br>
        <input type="text" class="ad-image-field3 widefat" value="<?php echo esc_attr($instance['href3']); ?>"
        name="<?php echo $this->get_field_name('href3'); ?>" id="<?php $this->get_field_id('href3'); ?>" />

        <a style="margin-top: 10px;"href="#" class="ad-upload-image3 button-primary"><?php _e('Upload', 'rookie') ?></a>
      </p>
    </div>

    <?php 
  }

  function admin_js($hook) {
    if($hook == 'widgets.php') { 
      wp_enqueue_media();
      wp_enqueue_script('wp_enqueue_script' , JS_URI . '/upload.js');
    }
  }

}

function reg_big_ads_widget() {
	register_widget('Rookie_Ads_big');
}

add_action('widgets_init' , 'reg_big_ads_widget');

