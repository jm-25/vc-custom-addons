<?php 
function sm_image_text( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'img' 	=> '',
       	'img_size' 	=> '',
       	'color' => 'transparent',
       	'link' => '',
       	'el_class' 	=> '',
       	'el_styles' 	=> ''       	
    ), $atts));
    $content = wpb_js_remove_wpautop($content, true);
		$rand = substr( md5(rand()), 0, 5);
		$url = wp_get_attachment_url($img);
		$img = explode('x', $img_size);
 		$width = $img[0];
		$height = ($img[1]?$img[1]:'null');
		$crop = ($img[1]?true:false);
		$url = aq_resize( $url, $width, $height,$crop) ;
		$link = vc_build_link( $link );
		$link =	$link['url'];
    ob_start();
    ?>

		<<?php echo ($link?'a href="'.$link.'" ':'div')?> class="<?php echo $el_class." " ?>image_text" style="<?php echo 'background-color:'.$color ?>">
				<img class="it_img" src="<?php echo $url ?>">
				
				<div class="it_container dark">
					<div class="inner">
						<?php echo $content ?>	
					</div>				
				</div>				
		</<?php echo ($link?'a':'div')?>>
		






		
		
				<?php
    $output_string = ob_get_contents();
    ob_end_clean();

    return $output_string;

}
add_shortcode('sm_image_text', 'sm_image_text');

function sm_image_text_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Image Background
	vc_map( array(
		"name" => __("Image & Text"),
		"base" => "sm_image_text",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"class" => "sm_image_text",
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "attach_image",
			  "heading" => __("Image"),
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
				'type' => 'textarea_html',
				'heading' => __( 'Image size', 'js_composer' ),
				'param_name' => 'content',
				'value' => '',
				'description' => __( 'Enter image size in pixels. Example: 200x100 (Width , Height).', 'js_composer' ),
			),
			array(
				'type' => 'vc_link',
				'heading' => __( 'Link', 'js_composer' ),
				'param_name' => 'link',
				'value' => '',
			),	
       array(
          "type" => "colorpicker",
          "heading" => __( "Color", "js_composer" ),
          "param_name" => "color",
          "value" => '', //Default Red color
          "description" => __( "Choose background color", "js_composer" )
       ),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra Class', 'js_composer' ),
				'param_name' => 'el_class',
				'value' => '',
				'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
			),							
		)
	) );	
	
}
add_action('init', 'sm_image_text_visualcomposer');
