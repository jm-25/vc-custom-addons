<?php 

function sm_bg_image( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'img' 	=> '',
       	'img_size' 	=> '',
       	'el_class' 	=> '',
       	'el_styles' 	=> ''       	
    ), $atts));
		$rand = substr( md5(rand()), 0, 5);
		$url = wp_get_attachment_url($img);
		if ($img_size){
			$img_sizes = explode('x', $img_size);
	 		$width = $img_sizes[0];
			$height = ($img_sizes[1]?$img_sizes[1]:'null');	
			$img_aq_url = aq_resize( $url, $width, $height) ;
			$img_url = ($img_aq_url?$img_aq_url:$url);	
		}else{
			$img_url = $url;
		}
    $out = '<div class="vc-bg-img '.$el_class.'" style="background-image:url('.$img_url.'); '.$el_styles.'"">';
		$out .= '</div>';

				
	  return $out;
}
add_shortcode('sm_bg_image', 'sm_bg_image');



add_action('init', 'sm_bg_image_visualcomposer');
function sm_bg_image_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Image Background
	vc_map( array(
		"name" => __("Background Image"),
		"base" => "sm_bg_image",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"class" => "bg_image",
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "attach_image",
			  "heading" => __("Background Image"),
			  "param_name" => "img",
			  "admin_label" => true,
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Image size', 'js_composer' ),
				'param_name' => 'img_size',
				'value' => '',
				'description' => __( 'Enter image size in pixels. Example: 200x100 (Width , Height).', 'js_composer' ),
			),		
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'js_composer' ),
				'param_name' => 'el_class',
				'value' => '',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
			),	
/*
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra Styles', 'js_composer' ),
				'param_name' => 'el_styles',
				'value' => '',
				'description' => __( 'Add your you custom styles to this element', 'js_composer' ),
			),		
*/					
		)
	) );
}
