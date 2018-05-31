<?php function sm_grid_gallery( $atts, $content = null ) {
    extract(shortcode_atts(array(
       	'images' 	=> '',
       	
    ), $atts));
		$rand = substr( md5(rand()), 0, 5);
    $images = explode( ',', $images );
		$width = 400;
		$height = 300;
    $out = '<div class="grid-gallery">';
		foreach ( $images as $image_id ) {
			$url = wp_get_attachment_url($image_id);
			$img = aq_resize( $url, $width, $height, true) ;
		$out .=	'<div class="columns small-6 medium-3 xlarge-2 hover-tilt">';
		$out .=			'<img src="'.$img.'" />';
		$out .= '<a href="'.$url.'" class="prettyphoto content-overlay" rel="prettyPhoto['.$rand.']"><div class="vertical-middle"><i class="fa fa-external-link-square"></i></div></a>';
		$out .=	'</div>';			
		} 
		$out .= '</div>';
		
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
				
	  return $out;
}
add_shortcode('sm_grid_gallery', 'sm_grid_gallery');

function sm_grid_gallery_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Grid Gallery
	vc_map( array(
		"name" => __("Grid Gallery"),
		"base" => "sm_grid_gallery",
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
add_action('init', 'sm_grid_gallery_visualcomposer');
