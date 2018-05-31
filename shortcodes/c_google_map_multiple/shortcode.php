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
	
	
	
function c_google_map_multiple( $atts, $content = null ) {
  extract(shortcode_atts(array(
      'height' 	=> '350px',
      'title' => 'LOCATION',
      'locations' => "'Location title', 20.777697, -105.532445, '1'",
      'url' =>'https://www.google.com/maps/d/embed?mid=zOglhxbZmVFo.kauk3DlOohmE'
  ), $atts));
	$rand = rand(10,10000);
  wp_enqueue_script('google-maps');

  ob_start();
  ?>

	<div class="c_google_map_multiple">		
		<div class="googleMap" id="map_canvas_<?php echo $rand ?>" style="height:<?php echo $height ?>px; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
		<span class="note">Click on the marker for directions</span>
	</div>
		
		
  <script type="text/javascript">
	function initMapMul<?php echo $rand; ?>() {
		
	    <?php $locations_lines = preg_split("/\\r\\n|\\r|\\n/", strip_tags($locations)); ?>	    	    
	    <?php foreach($locations_lines as $index => $loc)$locations_lines[$index] = trim($loc); ?>
	    
      var locations = [<?php echo '['.implode('],[', $locations_lines).']' ?>];
      var map = new google.maps.Map(document.getElementById('map_canvas_<?php echo $rand ?>'), {
	      zoom: 10,
	      center: new google.maps.LatLng(51.530616, -0.123125),
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    });
	
	    var infowindow = new google.maps.InfoWindow();
	
	    var marker, i;
	    var markers = new Array();
	
			var markerPin = {
			  url: 'https://image.flaticon.com/icons/svg/149/149059.svg',
			  scaledSize: new google.maps.Size(58, 58),
			  origin: new google.maps.Point(0, 0),
			  anchor: new google.maps.Point(24,58),
			  labelOrigin: new google.maps.Point(28,15)
			};	
			var markerIcon = {
			  url: '<?php echo plugins_url('marker-single.png', __FILE__); ?>',
			  size: new google.maps.Size(53, 73),
			  origin: new google.maps.Point(0, 0),
			  anchor: new google.maps.Point(26.5,73),
			  labelOrigin: new google.maps.Point(27,36.5)
			};	
			
	
	    for (i = 0; i < locations.length; i++) {  
	      marker = new google.maps.Marker({
	        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          icon: markerIcon,
	        map: map,
				  label: {
				    text: locations[i][3],
				    color: "#f1f1f1",
				    fontSize: "15px",
				    fontWeight: "bold"
				  }
	      });
	
	      markers.push(marker);
	
	      google.maps.event.addListener(marker, 'click', (function(marker, i) {
	        return function() {
	          infowindow.setContent(locations[i][0] + '<br>' + '<a href="https://www.google.com/maps/dir/?api=1&destination=' + locations[i][1] + ',' + locations[i][2] + '" target="_blank">Directions</a>');
	          infowindow.open(map, marker);
	        }
	      })(marker, i));	      
	    }
	
	    function AutoCenter() {
	      //  Create a new viewpoint bound
	      var bounds = new google.maps.LatLngBounds();
	      //  Go through each...
	      $.each(markers, function (index, marker) {
	      bounds.extend(marker.position);
	      });
	      //  Fit these bounds to the map
	      map.fitBounds(bounds);
	    }
	    AutoCenter();
	}
	$(document).ready(function(){
		initMapMul<?php echo $rand; ?>();
	});
	
  </script> 
  
		<?php
    $output_string = ob_get_contents();
    ob_end_clean();

    return $output_string;
}
add_shortcode('c_google_map_multiple', 'c_google_map_multiple');


add_action('init', 'c_google_map_multiple_visualcomposer');
function c_google_map_multiple_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Woocommerce Popup Button Shortcode
	vc_map( array(
		"name" => __("Google Map Multiple"),
		"base" => "c_google_map_multiple",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "textfield",
			  "heading" => __("Map Height"),
			  "param_name" => "height",
			  "admin_label" => false,
			),							
			array(
			  "type" => "textarea",
			  "heading" => __("Locations"),
			  "param_name" => "locations",
			  "description" => "'title(text)*', 'la(number)t*', 'long(number)*', 'index(number)*'<br>(use only single quotes - * Required)",
			  "admin_label" => false,
			),						
		)
	) );
	
	
	
}
