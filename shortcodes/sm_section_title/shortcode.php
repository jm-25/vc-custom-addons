<?php function sm_section_title( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'title' 	=> '',
       	'subtitle' 	=> '',
      	'text' 	=> '',
      	'class' => ''
    ), $atts));
	
	$out = '';
  $out .= '<div class="row section-header '.$class.'">';
  $out .= $title ? '	<h2 class="section-title"><span>'.$title.'</span></h2>':'';
  $out .= $subtitle ? '	<p class="section-subtitle">'.$subtitle.'</p>':'';
  $out .=	$text ?  '	<p class="section-lead">'.do_shortcode($text).'</p>':'';
  $out .= '</div>';
  return $out;
}
add_shortcode('sm_section_title', 'sm_section_title');

function sm_section_title_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
	
	// Section Title shortcode
	vc_map( array(
		"name" => __("Section Title"),
		"base" => "sm_section_title",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"class" => "section-header",
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "textfield",
			  "heading" => __("Title"),
			  "param_name" => "title",
			  "admin_label" => true,
			),
			
			array(
			  "type" => "textfield",
			  "heading" => __("Subtitle"),
			  "param_name" => "subtitle",
			  "admin_label" => true,
			),
			array(
				"type" => "textarea",
				"class" => "",
				"heading" => __("More Text"),
				"admin_label" => true,
				"param_name" => "text",
				"value" => "",
			),		
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Class"),
				"admin_label" => true,
				"param_name" => "class",
				"value" => "",
			)		
		)
	) );
		
}
add_action('init', 'sm_section_title_visualcomposer');
