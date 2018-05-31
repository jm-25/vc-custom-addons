<?php function child_pages( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'posts' 	=> '4',
    ), $atts));
	
    ob_start();
    ?>
				<div id="child-pages" class="row">
				
					<?php
						$args = array('orderby' => 'menu_order', 'order' => 'ASC', 'post_parent' => get_the_ID(), 'post_type' => 'page');
						$the_query = new WP_Query( $args );
					?>			
					<?php	if ( $the_query->have_posts() ): ?>
						
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<?php
								$thumb_id = get_post_thumbnail_id();
								$thumb_url = wp_get_attachment_url($thumb_id);
								$img = aq_resize( $thumb_url, 600, 437, true) ;	
							?>
							
							<div class="row archive-post">
								<div class="medium-5 columns thumb">
									<div class="hover-tilt">
										<?php if ($thumb_id): ?>
											<img src="<?php echo $img?>" alt="<?php echo get_the_title()?>">
										<?php endif; ?>	
										<a href="<?php the_permalink(); ?>" class="content-overlay">
											<div class="vertical-middle">
												<i class="fa fa-link"></i>
											</div>
										</a>
									</div>
								</div>
								<div class="medium-7 columns decription">
									<?php storefront_post_header(); ?>
									<?php the_excerpt(); ?>
									<a class="button  btn-medium right" href="<?php the_permalink(); ?>" title="<?php echo get_the_title() ?>">Learn More</a>
								</div>
							</div>
							<hr>
						<?php endwhile; ?>
								
						<?php wp_reset_postdata(); ?>
				
					<?php else : ?>
						<p><?php _e( 'Sorry, there are no child pages.' ); ?></p>
					<?php endif; ?>
									
								</div>
				<?php
    $output_string = ob_get_contents();
    ob_end_clean();

    return $output_string;
}
add_shortcode('child_pages', 'child_pages');
