<?php

/**
 * Container  Shortcode
 */
function header_slider( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'images' => '',
	    'id' => '',
    ), $atts));
    $id = ($id ? $id : 'header-slider-'.abs(rand()));
    $images = explode( ',', $images );
    $img_sizes = array("small" => 640, "medium" => 1024, "large" => 1200, "xlarge" => 1440, "xxlarge" => 1600);

    //$content = wpb_js_remove_wpautop($content, true);
    $content = apply_filters( 'gambit_ca_output', $content );
    $out = do_shortcode($content);    
    ob_start();
		?>
		<div class="header-slider" style="">	
		<div id="<?php echo $id ?>" class="hs-wrapper">	
		<?php foreach ( $images as $image_id ): ?>
			<?php
			 $di = ''; 	
			 foreach ( $img_sizes as $key => $size ){
				 $img = wp_get_attachment_image_src($image_id, 'full');
				 $img_url = $img[0];
				 $img_w =  $img[1];
				 $img_h =  $img[2];
/*
				 if ($img_w > $size || $img_h > $size){
					 $url = aq_resize( $img_url, $size, $size, true); 
					 $di .= "[".$url.", ".$key."]";
				 }
*/	 
				$url = aq_resize( $img_url, $size, 500);			
				}			
			?>
			<img class="hs-item" src="<?php echo $url; ?>">						
		<?php endforeach; ?>
		</div>
		<div class="row hs-content">
			<div class="columns large-12">
				<div class="hs-content-wrapper">
					<?php echo $out ?>
				</div>
			</div>
		</div>	
		</div>
		<script>
		jQuery(document).ready(function($){
			item_to_slick = $('#<?php echo $id ?>');			
			item_to_slick.slick({
			  autoplay: true,
			  arrows: true,
			  dots:false,
				autoplaySpeed: 2500,
				variableWidth: true,
			  centerMode: true,
			  //centerPadding: '60px',
			  slidesToShow: 1,
			  responsive: [
			    {
			      breakpoint: 768,
			      settings: {
			        centerMode: false,
			        variableWidth: false,
			        dots:false,
			        arrows:false,
			      }
			    },
			  ]
			});									
		});
		</script>		
		<?php
    $output_string = ob_get_contents();
    
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'header_slider', 'header_slider' );



function header_slider_visualcomposer() {
	vc_map( 
		array(
				"icon" 						=> plugins_url( 'icon.png', __FILE__ ),
		    'name' 						=> __('Header Slider'),
		    'base' 						=> 'header_slider',
				"category" 				=> "Theme elements",
				"params" 					=> array(
					array(
					  "type" => "attach_images",
					  "heading" => __("Images"),
					  "param_name" => "images",
					  "admin_label" => false,
					),									
					array(
					  "type" => "textarea_html",
					  "heading" => __("Text"),
					  "param_name" => "content",
					  "admin_label" => false,
					),									
					array(
					  "type" => "textfield",
					  "heading" => __("Custom ID"),
					  "description" => __("Add a custom identifier"),
					  "param_name" => "id",
					  "admin_label" => true,
					),
				)	
		) 
	);
}
add_action( 'vc_before_init', 'header_slider_visualcomposer' );

