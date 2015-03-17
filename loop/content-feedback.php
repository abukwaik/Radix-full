<?php
/**
 * @package Rookie
 * @author Abukwaik http://www.croti.com
 * @since rookie 1.0
 * 
 */
?>

<?php global $post; ?>

<div class="feedback-wrap clearfix">
    <?php
    $positive = (int) get_post_meta( $post->ID, 'positive', true );
    $negative = (int) get_post_meta( $post->ID, 'negative', true );

    $positive_title = $positive ? sprintf( _n( '%d person found this useful', '%d persons found this useful', $positive, 'rookie' ), $positive ) : __( 'No votes yet', 'rookie' );
    $negative_title = $negative ? sprintf( _n( '%d person found this not useful', '%d persons found this not useful', $negative, 'rookie' ), $negative ) : __( 'No votes yet', 'rookie' );
    ?>
    <div class="article-vote">
    	<span class="article-vote-question"><?php echo ro_get_option ('feedback_text'); ?></span>
    	<div class="article-vote-controls">
    		<a href="#" role="button" class="tip positive" data-id="<?php the_ID(); ?>" data-type="positive" title="<?php echo esc_attr( $positive_title ); ?>"><i class="fa fa-thumbs-up"></i> <?php echo $positive; ?></a>
    		<a href="#" role="button" class="tip negative" data-id="<?php the_ID(); ?>" data-type="negative" title="<?php echo esc_attr( $negative_title ); ?>"><i class="fa fa-thumbs-down"></i> <?php echo $negative; ?></a>
    	</div>
    </div>
</div>