<?php function vc_testimonial( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'name' 	=> '',
       	'quote' 	=> '',
      	'class' => ''
    ), $atts));
	
    ob_start();?>
[vc_column el_class="dark testimonial-row"]    
[vc_column_text css_animation="slideInLeft"]	
<div class="testimonial">
<p><?php echo $quote ?></p>
<p style="text-align: right;">- <?php echo $name ?></p>
</div>
[/vc_column_text]
[/vc_column]

    <?php 
	  $output_string = ob_get_contents();
    ob_end_clean();
    
    return do_shortcode($output_string);

}
add_shortcode('vc_testimonial', 'vc_testimonial');

function vc_testimonial_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
	
	// Section Title shortcode
	vc_map( array(
		"name" => __("Testimonial"),
		"base" => "vc_testimonial",
		//"icon" => plugins_url( 'icon.png', __FILE__ ),
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "textfield",
			  "heading" => __("Name"),
			  "param_name" => "name",
			  "admin_label" => true,
			),
			array(
				"type" => "textarea",
				"heading" => __("Quote"),
				"admin_label" => true,
				"param_name" => "quote",
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
add_action('init', 'vc_testimonial_visualcomposer');
