<?php

/**
 * Container  Shortcode
 */
function cc_quick_portfolio_grid( $atts, $content = null ) {
    extract(shortcode_atts(array(
    ), $atts));
    $content = apply_filters( 'gambit_ca_output', $content );
    $out = do_shortcode($content);    
    ob_start();?>
    	
		<div class="cc-quick-portfolio-grid">	
			<?php echo $out ?>
		</div>
		
		<script>
/*
		$(document).ready(function(){
			$('#<?php echo $id ?>').children().wrap( "<div class='custom-carousel-item'></div>" );
			$('#<?php echo $id ?>').slick({
			  <?php echo $params ?>
			});			
		});
*/
		</script>		
		
		<?php
    $output_string = ob_get_contents();    
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'cc_quick_portfolio_grid', 'cc_quick_portfolio_grid' );


function cc_portfolio_item( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'params' 	=> '',
	    'title' => '',
	    'image' => '',
	    'url' => '',
    ), $atts));
    ob_start(); ?>
    
    <?php echo $title ?>
    <?php echo $image ?>
    <?php echo $url ?>

    
		<?php
    $output_string = ob_get_contents();    
    ob_end_clean();
    return $output_string;
}
add_shortcode( 'cc_portfolio_item', 'cc_portfolio_item' );



function cc_quick_portfolio_grid_visualcomposer() {
	vc_map( 
		array(
				"icon" => plugins_url( 'icon.png', __FILE__ ),
		    'name' => __('Quick Porfolio Grid'),
		    'base' => 'cc_quick_portfolio_grid',
				"category" => "Custom Elements",
				'as_parent' => array( 'only' => 'cc_portfolio_item' ),
				'content_element' => true,
				'is_container' => true,
				"js_view" => 'VcColumnView',
				"params" => array(
/*
					array(
					  "type" => "exploded_textarea",
					  "heading" => __("Parameters"),
					  "description" => __("1 per line (no commas)"),
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
*/
				)	
		) 
	);
	vc_map( 
		array(
			"icon" => plugins_url( 'icon2.png', __FILE__ ),		
	    "name" => __('Porfolio Item'),
	    "base" => "cc_portfolio_item",
			"category" => "Custom Elements",	    
	    "content_element" => true,
	    "as_child" => array('only' => 'cc_quick_portfolio_grid'),
	    "params" => array(
	        // add params same as with any other content element
	        array(
	            "type" => "textfield",
	            "heading" => __("Title"),
	            "param_name" => "title",
	            "admin_label" => true,
	        ),
	        array(
	            "type" => "attach_image",
	            "heading" => __("Image"),
	            "param_name" => "image",
	        ),
	        array(
	            "type" => "vc_link",
	            "heading" => __("Link"),
	            "param_name" => "url",
	        )	        	        
	    )
		)
	);	


	//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
	if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	    class WPBakeryShortCode_cc_quick_portfolio_grid extends WPBakeryShortCodesContainer {
	    }
	}
	if ( class_exists( 'WPBakeryShortCode' ) ) {
	    class WPBakeryShortCode_cc_portfolio_item extends WPBakeryShortCode {
	    }
	}

}

add_action( 'vc_before_init', 'cc_quick_portfolio_grid_visualcomposer' );



