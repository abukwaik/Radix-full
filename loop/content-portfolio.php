<?php
/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 *
 */
?>

<?php $prefix = null; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemtype="http://schema.org/BlogPosting" itemscope="itemscope">
 
    <header class="entry-header">
        <h2 class="entry-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    </header><!-- .entry-header -->
    <div class="container-fluid clearfix">
        <div class="row">
            <div class="col-md-7 project-thumb">
                <?php rookie_post_thumbnail(); ?>
            </div> <!-- project-thumb -->

            <div class="col-md-5 project-sidebar">
                <h3 class="page-title"><?php echo __('Project details', 'rookie'); ?></h3>
                <div class="project-info">
                    <ul class="project-details unstyled">
                        <?php $portfolio_skills = get_the_term_list( get_the_ID(), 'portfolio-skills', ' ', ', ', ' ' );
                        if(!empty($portfolio_skills)) { ?>
                        <li>
                            <span class="project-skills">
                                <i class="fa fa-check-circle-o"></i>    
                                <strong><?php echo __('Skills: ', 'rookie') ?></strong>
                                <!-- for field -->
                                <?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'portfolio-skills', ' ', ', ', ' ') ); ?>       
                            </span>
                        </li>
                        <?php } ?>

                        <?php if (get_post_meta($post->ID, $prefix.'portfolio_client', true) !=''){ ?>
                        <li>
                            <span class="project-client">
                                <i class="fa fa-user"></i>
                                <!-- for meta  -->
                                <strong><?php echo __('Client name: ', 'rookie') ?></strong>
                                <?php echo get_post_meta($post->ID, $prefix.'portfolio_client', true); ?>
                            </span>
                        </li>
                        <?php } ?>
                        <li>
                            <span class="project-date">
                                <i class="fa fa-calendar"></i>  
                                <strong><?php echo __('Start Date: ', 'rookie') ?></strong>
                                <?php the_time( get_option( 'date_format' ) ); // the_time('d F Y'); ?>
                            </span> 
                        </li>
                        <?php if (get_post_meta($post->ID, $prefix.'portfolio_duration', true) !=''){ ?>
                        <li>
                            <span class="project-duration">
                                <i class="fa fa-clock-o"></i>
                                <!-- for meta  -->
                                <strong><?php echo __('Duration: ', 'rookie') ?></strong>
                                <?php echo get_post_meta($post->ID, $prefix.'portfolio_duration', true); ?>
                            </span>
                        </li>
                        <?php } ?>
                        <!-- for meta  -->
                        <?php if (get_post_meta($post->ID, $prefix.'portfolio_budget', true) !=''){ ?>
                        <li>
                            <span class="project-budget">   
                                <i class="fa fa-usd"></i>
                                <strong><?php echo __('Budget: ', 'rookie') ?></strong>
                                <?php echo get_post_meta($post->ID, $prefix.'portfolio_budget', true); ?>
                            </span>
                        </li> 
                        <?php } ?>
                        <?php if (get_post_meta($post->ID, $prefix.'portfolio_website_url', true) !=''){ ?>
                        <li>
                            <span class="project-url">
                                <i class="fa fa-link"></i>
                                <!-- for meta  -->
                                <strong><?php echo __('Website: ', 'rookie') ?></strong>
                                <a href="<?php echo get_post_meta($post->ID, $prefix.'portfolio_website_url', true); ?>"><?php echo get_post_meta($post->ID, $prefix.'portfolio_website_url', true); ?></a>                     
                            </span>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php if (get_post_meta($post->ID, $prefix.'portfolio_project_button', true) !=''){ ?>
                    <div class="project-button">
                        <a class="btn btn-default btn-min-block" target="_blank" href="<?php echo get_post_meta($post->ID, $prefix.'portfolio_website_url', true); ?>"><?php echo get_post_meta($post->ID, $prefix.'portfolio_project_button', true); ?></a>                        
                    </div>
                    <?php } ?>
                    <hr>
                    <div class="project-socials">
                        <?php portfolio_socials(); ?>
                        <span class="project-views pull-right small">
                            <i class="fa fa-eye"></i>           
                            <?php echo getPostViews(get_the_ID()); ?>   
                        </span>
                    </div>
                    <br>
                    <div class="entry-footer">
                        <span class="project-tags">
                            <i class="fa fa-tags"></i>  
                            <strong><?php echo __('Tagged: ', 'rookie') ?></strong>
                            <!-- for field -->
                            <?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'portfolio-tags', ' ', ', ', ' ') ); ?>
                        </span>
                        <span class="project-categories">
                            <i class="fa fa-folder-open"></i>
                            <strong><?php echo __('Categories: ', 'rookie') ?></strong>
                            <?php echo wp_strip_all_tags( get_the_term_list( get_the_ID(), 'portfolio-categories', ' ', ', ', ' ') ); ?>
                        </span>             
                    </div> <!-- entry-footer -->
                </div>
            </div> <!-- project-sidebar -->

            <div class="clearfix"></div>

            <div class="project-description">
                <h3 class="recent-title"><?php echo __('Project Description', 'rookie'); ?></h3>
                <?php the_content(); ?>
            </div> <!-- project-description -->
            <?php if (ro_get_option ('related_posts')) { ?>
            <?php do_related_posts (); ?>
            <?php } ?>
        </div>
    </div>
</article>







