<?php function sm_button( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'text' 	=> '',
       	'link' 	=> '',
      	'color' 	=> '',
      	'align' 	=> '',
      	'size' 	=> '',
      	'class' 	=> ''
    ), $atts));
	
	if($color){
		$style = 'style="background-color:'.$color.'"';
	}
	$href = vc_build_link( $link );
	$href = $href['url'];

	$out = '';
	$out .= '<div class="'.$align.' wpb_content_element">';
	$out .= '	<a href="'.$href.'" class="button '.$class.' '.$size.'" '.$style.'>'.$text.'</a>';
	$out .= '</div>';  return $out;
}
add_shortcode('sm_button', 'sm_button');


function sm_button_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
	// button
	vc_map( array(
		"name" => __("Button"),
		"base" => "sm_button",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"class" => "sm_button",
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "textfield",
			  "heading" => __("Text"),
			  "param_name" => "text",
			  "admin_label" => true,
			),
			
			array(
			  "type" => "vc_link",
			  "heading" => __("URL Link"),
			  "param_name" => "link",
			  "admin_label" => true,
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Color"),
				"param_name" => "color",
				"admin_label" => true,
			),
			array(
				"type" => "dropdown",
				"heading" => __("Choose Aligment"),
				"param_name" => "align",
				"admin_label" => true,
		  	"value" => array(
		  		"Left" => "text-left",
		  		"Right" => "text-right",
		  		"Center" => "text-center"
		  	)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Size"),
				"param_name" => "size",
				"admin_label" => true,
		  	"value" => array(
		  		"Small" => "small",
		  		"Medium" => "medium",
		  		"Large" => "large",
		  	)
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name"),
				"param_name" => "class",
				"admin_label" => true,
			)		
		)
	) );

		
}
add_action('init', 'sm_button_visualcomposer');
