<?php function sm_carousel_team( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'el_class' 	=> ''
    ), $atts));
		$width = 400;
		$height = 400;		

		$args = array('orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => 'team');
		$the_query = new WP_Query( $args );


    ob_start();
		?>
		<div class="grid-gallery sm-carousel-team">
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php	$img = 	aq_resize( wp_get_attachment_url(get_post_thumbnail_id()), $width, $height, true); ?>
			<div class="columns small-6 medium-3 xlarge-2 hover-tilt">
				<img src="<?php echo $img ?>" />
				<a href="<?php echo get_the_permalink() ?>" class="content-overlay">
					<div class="the-title vertical-middle"><? the_title(); ?></div>
				</a>
			</div>
			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>
		</div>
		<script>
		jQuery(document).ready(function($) {	
			$('.sm-carousel-team').slick({
			  dots: false,
			  infinite: true,
			  speed: 300,
			  autoplay: true,
				autoplaySpeed: 2000,
				pauseOnFocus: false,
			  slidesToShow: 4,
			  slidesToScroll: 1,
			  responsive: [
			    {
			      breakpoint: 1024,
			      settings: {
			        slidesToShow: 3,
			        infinite: true,
			        dots: true
			      }
			    },
			    {
			      breakpoint: 600,
			      settings: {
			        slidesToShow: 2,
			      }
			    },
			    {
			      breakpoint: 480,
			      settings: {
			        slidesToShow: 1,
			      }
			    }
			    // You can unslick at a given breakpoint now by adding:
			    // settings: "unslick"
			    // instead of a settings object
			  ]
			});
		});
		</script>		
		<?php
    $output_string = ob_get_contents();
    
    ob_end_clean();
    return $output_string;

}
add_shortcode('sm_carousel_team', 'sm_carousel_team');

function sm_carousel_team_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Grid Gallery
	vc_map( array(
		"name" => __("Team Slick Carousel"),
		"base" => "sm_carousel_team",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"class" => "grid_gallery",
		"category" => "Theme elements",
		"params" => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'value' => '',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
			)
		)
	) );
		
}
add_action('init', 'sm_carousel_team_visualcomposer');
