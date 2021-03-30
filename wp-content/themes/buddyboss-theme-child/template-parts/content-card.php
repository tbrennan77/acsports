<?php
/**
 * Template part for displaying job content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package BuddyBoss_Theme
 */
?>

<?php 
global $post;


// Get ACF data
$image_front        = get_field('card_front_image');
$image_back         = get_field('card_back_image');
$card_first_name    = get_field('card_first_name');
$card_last_name     = get_field('card_last_name');
$card_sport         = get_field('card_sport');
$card_team          = get_field('card_team');
$card_brand         = get_field('card_brand');
$card_is_graded     = get_field('card_is_graded');
$card_is_pc         = get_field('card_is_pc');
$card_is_fs         = get_field('card_is_fs');
$card_is_ft         = get_field('card_is_ft');
$card_sale_price    = get_field('card_sale_price');
$card_trade_demand  = get_field('card_trade_demand');

echo $image_front . "<br />";
echo $image_back . "<br />";
echo $card_first_name . "<br />";
echo $card_last_name . "<br />";
echo $card_sport . "<br />";
echo $card_team . "<br />";
echo $card_brand . "<br />";
echo $card_is_graded . "<br />";
echo $card_is_pc . "<br />";
echo $card_is_fs . "<br />";
echo $card_is_ft . "<br />";
echo $card_sale_price . "<br />";
echo $card_trade_demand . "<br />";

//echo the_meta();

// $image_id  = get_post_meta( $post->ID, 'card_front_image', true );
// $image_src = wp_get_attachment_url( $image_id );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<img id="book_image" src="<?php echo $image_front ?>" style="max-width:100%;" />
		<div class="entry-content-wrap">
            <?php if( !empty( $image ) ): ?>
            <aside class="featured-image">
                
            </aside>
            <?php endif; ?>
			<header class="entry-header">
				<?php
				if ( is_singular() && ! is_related_posts() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
                    $prefix = "";
                    if( has_post_format( 'link' ) ){
                        $prefix = __( '[Link]', 'buddyboss-theme' );
                        $prefix .= " ";//whitespace
                    }
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $prefix, '</a></h2>' );
				endif;
				?>
                
                <?php if( has_post_format( 'link' ) && function_exists( 'buddyboss_theme_get_first_url_content' ) && ( $first_url = buddyboss_theme_get_first_url_content( $post->post_content ) ) != "" ):?>
                <p class="post-main-link"><?php echo $first_url;?></p>
                <?php endif; ?>
			</header><!-- .entry-header -->
            
            <?php do_action( 'single_job_listing_meta_before' ); ?>
            
            <div class="job-listing-meta-wrap">
                <ul class="job-listing-meta meta">
                	<?php do_action( 'single_job_listing_meta_start' ); ?>
                
                	<?php if ( get_option( 'job_manager_enable_types' ) ) { ?>
                		<?php $types = wpjm_get_the_job_types(); ?>
                		<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
                
                			<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
                
                		<?php endforeach; endif; ?>
                	<?php } ?>
                
                	<li class="location"><?php the_job_location(); ?></li>
                
                	<li class="date-posted"><?php the_job_publish_date(); ?></li>
                
                	<?php if ( is_position_filled() ) : ?>
                		<li class="position-filled"><?php _e( 'This position has been filled', 'buddyboss-theme' ); ?></li>
                	<?php elseif ( ! candidates_can_apply() && 'preview' !== $post->post_status ) : ?>
                		<li class="listing-expired"><?php _e( 'Applications have closed', 'buddyboss-theme' ); ?></li>
                	<?php endif; ?>
                
                	<?php do_action( 'single_job_listing_meta_end' ); ?>
                </ul>
            </div>
            
            <div class="entry-content-job">
            
                <div class="entry-primary">

        			<?php if ( !is_singular() || is_related_posts() ) { ?>
        				<div class="entry-content">
        					<?php the_excerpt(); ?>
        				</div>
        			<?php } ?>
        
        			
                
        			<div class="entry-content">
                        <?php the_company_video(); ?>
        				<?php
        				if ( is_singular() && ! is_related_posts() ) {
        					the_content( sprintf(
        					wp_kses(
        					/* translators: %s: Name of current post. Only visible to screen readers */
        					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'buddyboss-theme' ), array(
        						'span' => array(
        							'class' => array(),
        						),
        					)
        					), get_the_title()
        					) );
        				}
        				?>
        			</div><!-- .entry-content -->
                    
                </div>
                <div class="entry-secondary">
                    <div class="single-job-sidebar">
                        <?php if ( is_single() && ! is_related_posts() ) { ?>
            				<?php if ( has_post_thumbnail() ) { ?>
            					<div class="job-media job-img">
  						            <?php the_post_thumbnail( 'medium' ); ?>
                                    <?php //the_company_logo(); ?>
            					</div>
            				<?php } ?>
            			<?php } ?>
                        <div class="company-bar">
                            <?php if ( candidates_can_apply() ) : ?>
                    			<?php get_job_manager_template( 'job-application.php' ); ?>
                    		<?php endif; ?>
                            
                            <h3><?php echo __( 'Contact us', 'buddyboss-theme' ); ?></h3>
                            <div class="name-meta"><?php the_company_name( '<strong>', '</strong>' ); ?></div>
                    		<?php if ( $website = get_the_company_website() ) : ?>
                                <?php
                                $url = preg_replace('#^https?://#', '', rtrim($website,'/'));
                                ?>
                    			<div class="name-meta"><a class="website" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow"><?php echo $url; ?></a></div>
                    		<?php endif; ?>
                    		<div class="name-meta"><?php the_company_twitter(); ?></div>
                        	<?php the_company_tagline( '<p class="tagline">', '</p>' ); ?>
                            <div class="job-listing-meta-after-wrap">
                                <?php do_action( 'single_job_listing_meta_after' ); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
		</div>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
get_template_part( 'template-parts/related-jobs' );
