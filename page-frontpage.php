<?php
/**
* Template Name: Frontpage
* inspired from shapebootstrap http://shapebootstrap.net/
*
* @package Rookie
* @since rookie 1.0
*/

get_header(); ?>

<?php
    $args = array( 
        'post_type' => 'rookie_slider',
        'orderby'   => 'menu_order',
        'order'     => 'ASC' 
        );

    $sliders = get_posts( $args );
    $total_sliders = count($sliders);
?>

<section id="main-slider" class="carousel no-margin" data-ride="carousel">
    <div class="carousel slide">
        <ol class="carousel-indicators">
            <?php for($i = 0; $i<$total_sliders; $i++){ ?>
            <li data-target="#main-slider" data-slide-to="<?php echo $i ?>" class="<?php echo ($i==0)?'active':'' ?>"></li>
            <?php } ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($sliders as $key => $slider) { 
                $full_img           =   wp_get_attachment_image_src( get_post_thumbnail_id( $slider->ID ), 'full');
                $slider_position    =   get_post_meta($slider->ID, 'slider_position', true );
                $boxed              =   (get_post_meta($slider->ID, 'slider_boxed', true )=='yes') ? 'boxed' : '';
                $has_button         =   (get_post_meta($slider->ID, 'slider_button_text', true )=='') ? false : true;
                $button             =   get_post_meta($slider->ID, 'slider_button_text', true );
                $button_url         =   get_post_meta($slider->ID, 'slider_button_url', true );
                $video_url          =   get_post_meta($slider->ID, 'slider_video_link', true );
                $video_type         =   get_post_meta($slider->ID, 'slider_video_type', true );
                $bg_image_url       =   get_post_meta($slider->ID, 'slider_background_image', true );
                $background_image   =   'background-image: url('.wp_get_attachment_url($bg_image_url).')';
                $columns            =   false;

                if (!empty($image_url) or !empty($video_url) ){
                    $columns        =   true;
                }

                if ($video_type=='youtube' ) {
                    $embed_code = '<div class="youtube" id="' . get_video_ID( $video_url ) . '"></div>';
                } 
                elseif ($video_type=='vimeo' ) {
                    $embed_code = '<iframe src="//player.vimeo.com/video/' . get_video_ID( $video_url ) . '" style="border:0;"></iframe>';
                }
                if ($full_img ){
                    $embed_code     = '<img src="' . $full_img[0] . '" alt="">';
                    $columns        =   true;
                }
                ?>
                <div class="item <?php echo ($key==0) ? 'active' : '' ?>" style="<?php echo ( $bg_image_url ) ? $background_image : '' ?>">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="<?php echo ($columns) ? 'col-sm-6' : 'col-sm-12' ?>">
                                <div class="carousel-content">
                                    <h2 class="<?php echo $boxed ?> animation animated-item-1"><?php echo $slider->post_title ?></h2>
                                    <div class="<?php echo $boxed ?> animation animated-item-2 slider-text">
                                        <?php echo do_shortcode( $slider->post_content ) ?>
                                    </div>
                                    <?php if( $has_button ){ ?>
                                    <a class="btn btn-clear btn-min-block animation animated-item-3" href="<?php echo $button_url ?>"><?php echo $button ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php if($columns){ ?>
                            <div class="col-sm-6 hidden-xs animation animated-item-4">
                                <div class="youtube-embed">
                                    <?php echo $embed_code; ?>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div><!--/.item-->
                <?php } // endforeach ?>
            </div><!--/.carousel-inner-->
        </div><!--/.carousel-->
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section><!--/#main-slider-->
<?php the_post(); ?>
<?php the_content(); ?>
<?php get_footer(); ?>
