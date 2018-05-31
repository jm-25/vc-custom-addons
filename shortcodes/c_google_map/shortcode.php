<?php 
add_action( 'wp_enqueue_scripts', 'c_google_map_script' );
if (!function_exists('c_google_map_script')) {
	function c_google_map_script() {
		wp_register_script( 
		  'google-maps', 
		  '//maps.googleapis.com/maps/api/js?key=AIzaSyA1SjkmHrLQIbylYJIYNmWC_krhPd_cf4g', 
		  array('jquery'), 
		  null, 
		  true 
		);
	}
}

		
function c_google_map( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'height' 	=> '350',
        'title' => 'LOCATION',
        'text' => 'Some text',
        'lat' => '20.748675',
        'lon' => '-105.315630',
        'zoom' => '15',
        'url' =>'https://www.google.com/maps/d/embed?mid=zOglhxbZmVFo.kauk3DlOohmE'
    ), $atts));
		$rand = rand(10,10000);
		
    wp_enqueue_script('google-maps');
		
    ob_start();
    ?>

		<div class="c_google_map">
				<div class="googleMap" id="map_canvas_<?php echo $rand ?>" style="height:<?php echo $height ?>px	;overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
				<a class="directions-link" href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $lat ?>,<?php echo $lon ?>" target="_blank">Get Directions</a>
		</div>
		
		
  <script type="text/javascript">
	function initMap<?php echo $rand; ?> () {
        var location = {lat: <?php echo $lat ?>, lng: <?php echo $lon ?>};
        var map = new google.maps.Map(document.getElementById('map_canvas_<?php echo $rand ?>'), {
          zoom: <?php echo $zoom ?>,
          center: location
        });

        var contentString = '<div id="content">'+
            '<h4 id="firstHeading" class="firstHeading"><?php echo $title ?></h4>'+
            '<div id="bodyContent">'+ 
            '<?php echo $text ?>'+
            '<div class="adress-link">'+ 
            '<a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $lat ?>,<?php echo $lon ?>" target="_blank">Directions</a>' +
						'</div>'+ 
            '</div>'+
            '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        
				var markerIcon = {
				  url: '<?php echo plugins_url('marker-single.png', __FILE__); ?>',
				  size: new google.maps.Size(53, 73),
				  origin: new google.maps.Point(0, 0),
				  anchor: new google.maps.Point(26.5,73),
				  labelOrigin: new google.maps.Point(27,36.5)
				};	

        var marker = new google.maps.Marker({
          position: location,
          icon: markerIcon,
	        animation:  google.maps.Animation.DROP,
          map: map,
          title: '<?php echo $title ?>'
        });
/*
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });	
        infowindow.open(map, marker);	
*/
		}
		$(document).ready(function(){
			initMap<?php echo $rand; ?>();
		});
  </script> 
<!--
  <script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1SjkmHrLQIbylYJIYNmWC_krhPd_cf4g&callback=initMap<?php echo $rand ?>">
  </script>
-->
  
				<?php
    $output_string = ob_get_contents();
    ob_end_clean();

    return $output_string;
}
add_shortcode('c_google_map', 'c_google_map');


add_action('init', 'c_google_map_visualcomposer');
function c_google_map_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Woocommerce Popup Button Shortcode
	vc_map( array(
		"name" => __("Google Map"),
		"base" => "c_google_map",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		//"class" => "thb_vc_sc_gap",
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
			  "heading" => __("Latitud"),
			  "value" => "20.748675",
			  "param_name" => "lat",
			  "admin_label" => true,
			),							
			array(
			  "type" => "textfield",
			  "heading" => __("Longitud"),
			  "value" => "-105.315630",
			  "param_name" => "lon",
			  "admin_label" => true,
			),									
			array(
			  "type" => "textfield",
			  "heading" => __("Zoom"),
			  "param_name" => "zoom",
			  "admin_label" => false,
			),						
			array(
			  "type" => "textfield",
			  "heading" => __("Height"),
			  "param_name" => "height",
			  "admin_label" => false,
			),						
/*
			array(
			  "type" => "textarea",
			  "heading" => __("Text"),
			  "param_name" => "text",
			  "admin_label" => true,
			),						

			array(
			  "type" => "textfield",
			  "heading" => __("URL"),
			  "param_name" => "url",
			  "admin_label" => true,
			),	
*/						
		)
	) );
	
	
	
}
