<?php 

/**
 *
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */

class Rookie_Ads_small extends WP_Widget {

  function Rookie_Ads_small() {
    $widget_ops = array('classname' => 'rookie-ads-small','description' => __( "Rookie Ads Small" ,'rookie') );
    $this->WP_Widget('Rookie-ads-small', __('Rookie Ads Small','rookie'), $widget_ops);

    // add image js 
    add_action('admin_enqueue_scripts' , array(&$this , 'admin_js') , 99 , 1);
  }

  function widget($args , $instance) {
    extract($args); 
    $title = ($instance['title']) ? $instance['title'] : __('' , 'rookie');
    $url = ($instance['url']) ? $instance['url'] : '#';
    $href = ($instance['href']) ? $instance['href'] : 'http://dummyimage.com/90x90/644c80/ffffff.png';
    $url2 = ($instance['url2']) ? $instance['url2'] : '#';
    $href2 = ($instance['href2']) ? $instance['href2'] : 'http://dummyimage.com/90x90/644c80/ffffff.png';

    echo $before_widget;
    
    if ($title) { 
      echo $before_title . $title . $after_title; 
    }

    ?>

    <div class="ads-container clearfix">
      <div class="ads-sm">
        <div class="col-xs-6">
          <?php if(isset($url) && $url != '') {
            echo '<a class="ads-widget-wrapper" href="'.$url.'"><img src="'.$href.'" alt="'.$title.'" /></a>';
          } ?>
        </div>
        <div class="col-xs-6">
          <?php if(isset($url2) && $url2 != '') {
            echo '<a class="ads-widget-wrapper" href="'.$url2.'"><img src="'.$href2.'" alt="'.$title.'" /></a>';
          } ?>
        </div>      
      </div>
    </div>

    <?php echo $after_widget;
  }

  function form($instance) {
    if(!isset($instance['title'])) $instance['title'] = __('Advertisement' , 'rookie');
    if(!isset($instance['url'])) $instance['url'] = '#';
    if(!isset($instance['href'])) $instance['href'] = '';
    if(!isset($instance['url2'])) $instance['url2'] = '#';
    if(!isset($instance['href2'])) $instance['href2'] = '';

    ?>

    <div class="widget-content">
      <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ','rookie') ?></label>
        <br>
        <input type="text" class="widefat" value="<?php echo esc_attr($instance['title']); ?>"
        name="<?php echo $this->get_field_name('title'); ?>" id="<?php $this->get_field_id('title'); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Link: ','rookie') ?></label>
        <br>
        <input type="text" class="widefat" value="<?php echo esc_attr($instance['url']); ?>"
        name="<?php echo $this->get_field_name('url'); ?>" id="<?php $this->get_field_id('url'); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('img'); ?>"> <?php _e('Image Url:', 'rookie') ?></label>
        <br>
        <input type="text" class="ad-image-field widefat" value="<?php echo esc_attr($instance['href']); ?>"
        name="<?php echo $this->get_field_name('href'); ?>" id="<?php $this->get_field_id('href'); ?>" />

        <a style="margin-top: 10px;"href="#" class="ad-upload-image button-primary"><?php _e('Upload', 'rookie') ?></a>
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('url2'); ?>"><?php _e('Link: ','rookie') ?></label>
        <br>
        <input type="text" class="widefat" value="<?php echo esc_attr($instance['url2']); ?>"
        name="<?php echo $this->get_field_name('url2'); ?>" id="<?php $this->get_field_id('url2'); ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_id('img2'); ?>"> <?php _e('Image Url:', 'rookie') ?></label>
        <br>
        <input type="text" class="ad-image-field2 widefat" value="<?php echo esc_attr($instance['href2']); ?>"
        name="<?php echo $this->get_field_name('href2'); ?>" id="<?php $this->get_field_id('href2'); ?>" />

        <a style="margin-top: 10px;"href="#" class="ad-upload-image2 button-primary"><?php _e('Upload', 'rookie') ?></a>
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

function reg_small_ads_widget() {
  register_widget('Rookie_Ads_small');
}

add_action('widgets_init' , 'reg_small_ads_widget');

