<?php function sm_carousel( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'images' 	=> '',
       	
    ), $atts));
		$rand = substr( md5(rand()), 0, 5);
    $images = explode( ',', $images );
		$width = 400;
		$height = 400;		
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		
    ob_start();
		?>
		<div class="grid-gallery sm-carousel">
		<?php foreach ( $images as $image_id ) : ?>
		<?php	$url = wp_get_attachment_url($image_id);$img = aq_resize( $url, $width, $height, true); ?>
			<div class="columns small-6 medium-3 xlarge-2 hover-tilt">
				<img src="<?php echo $img ?>" />
				<a href="<?php echo $url ?>" class="prettyphoto content-overlay" rel="prettyPhoto[<?php echo $rand ?>]">
					<div class="vertical-middle"><i class="fa fa-external-link-square"></i></div>
				</a>
			</div>
		<?php endforeach; ?>	
		</div>
		<script>
		jQuery(document).ready(function($) {	
			$('.sm-carousel').slick({
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
add_shortcode('sm_carousel', 'sm_carousel');

function sm_carousel_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Grid Gallery
	vc_map( array(
		"name" => __("Slick Carousel"),
		"base" => "sm_carousel",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"class" => "grid_gallery",
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "attach_images",
			  "heading" => __("Images"),
			  "param_name" => "images",
			  "admin_label" => true,
			)
		)
	) );
		
}
add_action('init', 'sm_carousel_visualcomposer');
