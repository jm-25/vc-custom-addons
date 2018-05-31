<?php

/**
 * Container  Shortcode
 */
function custom_carousel( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'params' 	=> '',
	    'id' => '',
    ), $atts));
    $class = 'custom-carousel-'.abs(rand());
    $content = apply_filters( 'gambit_ca_output', $content );
    $out = do_shortcode($content);   
    $params = rawurldecode( base64_decode( strip_tags( $params ) ) ); 
    ob_start();
		?>	
		<div id="<?php echo $id ?>" class="<?php echo $class ?> custom-carousel">	
			<?php echo $out ?>
		</div>
		<script>
		$(document).ready(function(){
			var sliderID = $('.<?php echo $class ?>'); 
			sliderID.hide();
			sliderID.children().wrap( "<div class='custom-carousel-item'></div>" );
			sliderID.children('custom-carousel-item').height($(this).closest( ".vc_row.vc_row-o-full-height" ).height());
			sliderID.slick({
			  <?php echo $params ?>
			});					
		});
		$(window).on("load resize",function(e){
			var sliderID = $('.<?php echo $class ?>');
			if(sliderID.closest( ".vc_row" ).hasClass('vc_row-o-full-height')){
				sliderID.find('.custom-carousel-item > .vc_inner').height(sliderID.closest('.vc_row').height());
			}
			sliderID.show();	
		});			
		</script>		
		<?php
    $output_string = ob_get_contents();
    
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'custom_carousel', 'custom_carousel' );



function custom_carousel_visualcomposer() {
	vc_map( 
		array(
				"icon" => plugins_url( 'icon.png', __FILE__ ),
		    'name'                    => __('Slick Carousel'),
		    'base'                    => 'custom_carousel',
				"category" => "Theme elements",
				'as_parent' => array( 'only' => 'vc_single_image, vc_column_text' ),
				'js_view' => 'VcColumnView',
				'content_element' => true,
				'is_container' => true,
				//'container_not_allowed' => false,
				'default_content' => $default_content,	
				"params" => array(
					array(
					  "type" => "textarea_raw_html",
					  "heading" => __("Parameters"),
					  "description" => __("http://kenwheeler.github.io/slick/"),
					  "param_name" => "params",
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
add_action( 'vc_before_init', 'custom_carousel_visualcomposer' );

// A must for container functionality, replace Wbc_Item with your base name from mapping for parent container
if(class_exists('WPBakeryShortCodesContainer')){
    class WPBakeryShortCode_custom_carousel extends WPBakeryShortCodesContainer {

    }
}

