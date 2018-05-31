<?php function custom_google_map( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'height' 	=> '700',
        'title' => 'LOCATION',
        'text' => '',
        'lat' => '20.777697',
        'lon' => '-105.315630',
        'zoom'=> '12',
        'url' =>'https://www.google.com/maps/d/embed?mid=zOglhxbZmVFo.kauk3DlOohmE'
    ), $atts));



    ob_start();
    ?>

		<div class="custom_google_map">
				
				<div class="inner-map">
					
<!--
					<a class="map-circle dark section-header" href="<?php echo $url ?>" target="_blank">
						<div class="map-text">
							<h2 class="section-title"><?php echo $title ?></h2>
						
							<p>
								<?php echo $text ?>
							</p>
						</div>
					</a>
-->
					
				</div>
				
				<div class="googleMap" id="map_canvas" style="height:350px	;overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
		</div>
		
		
    <script>

      function initMap() {


				var locations = [
// 			      ['Residents beach club', <?php echo $lat; ?>, <?php echo $lon; ?>, 0],					
			      ['<?php echo $title; ?>', <?php echo $lat; ?>, <?php echo $lon; ?>, 0],
// 			      ['Capri Beach Club', 20.781955, -105.508493, 1]
			    ];


        var map = new google.maps.Map(document.getElementById('map_canvas'), {
          zoom: <?php echo $zoom; ?>,
          center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lon; ?>),
          mapTypeId: google.maps.MapTypeId.ROADMAP,
					scrollwheel: false,
					draggable: false
        });
        var marker, i;
				for (i = 0; i < locations.length; i++) {
	        var marker = new google.maps.Marker({
	          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
	          icon: "<?php echo plugins_url('marker.png', __FILE__); ?>",
	          animation:  google.maps.Animation.DROP,
	          map: map,
	          title: locations[i][0]
	        });

	        google.maps.event.addListener(marker, 'click', (function(marker, i) {
	            return function() {
	            //window.location.href = 'http://maps.google.com/maps?&z=10&q='+locations[i][1]+'+'+locations[i][2]+'&ll='+locations[i][1]+'+'+locations[i][2]+'';
	            //window.open('http://maps.google.com/maps?&z=10&q='+locations[i][1]+'+'+locations[i][2]+'&ll='+locations[i][1]+'+'+locations[i][2]+'', '_blank');
	            window.open('https://maps.googleapis.com/maps/api/directions/json?origin=Toronto&destination=Montreal', '_blank');
	            }
	        })(marker, i));					      
        }
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1SjkmHrLQIbylYJIYNmWC_krhPd_cf4g&callback=initMap">
    </script>
		
				<?php
    $output_string = ob_get_contents();
    ob_end_clean();

    return $output_string;
}
add_shortcode('custom_google_map', 'custom_google_map');


add_action('init', 'custom_google_map_visualcomposer');
function custom_google_map_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
  	
	// Woocommerce Popup Button Shortcode
	vc_map( array(
		"name" => __("Custom Google Map"),
		"base" => "custom_google_map",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		//"class" => "thb_vc_sc_gap",
		"category" => "Theme elements",
		"params" => array(
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
			  "heading" => __("Title"),
			  "param_name" => "title",
			  "admin_label" => true,
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
