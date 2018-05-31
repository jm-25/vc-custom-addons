<?php 	
function show_more( $atts, $content = null ) {	

    extract(shortcode_atts(array(
        'content' => $content,
    ), $atts));
 
    $uniqueID = rand(0001,1000);
    		
    ob_start();

			?>				
			<section id="ee" class="id-<?php echo $uniqueID; ?>">
						<div class="ee-content ">
							<?php echo apply_filters('the_content', $content); ?>
							<?php //the_content(); ?>
							<?php //echo apply_filters('the_content', $extended); ?>
						</div>
						<span class="ee-button button"> Show More </span>					
				<script>			
					
					ee_element = $("#ee.id-<?php echo $uniqueID; ?> .ee-content");
					ee_button = $("#ee.id-<?php echo $uniqueID; ?> .ee-button");
					ee_element.css("display","none");
					ee_button.click(function(){
		        if($(this).hasClass("less")) {
		            $(this).removeClass("less");
		            $(this).html("Show More");
		            $(this).parent().find(".ee-content").slideToggle(1500);
      
		        } else {
		            $(this).addClass("less");
		            $(this).html("Show Less");
		            $(this).parent().find(".ee-content").slideToggle(1500);
		        }
		      });			 					
				</script>	
			</section>
		<?php
		wp_reset_query();
    $output_string = ob_get_contents();
    ob_end_clean();
    
    return $output_string;
}
add_shortcode('show_more', 'show_more');

function show_more_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) {
		return;
	}
	
	// Section Title shortcode
	vc_map( array(
		"name" => __("Expandable Element"),
		"base" => "show_more",
		//"icon" => plugins_url( 'icon.png', __FILE__ ),
		"category" => "Theme elements",
		"params" => array(
			array(
			  "type" => "textarea_html",
			  "heading" => __("Text Content"),
			  "param_name" => "content",
			  "admin_label" => false,
			),
			) 
		)
	)	;
}
add_action('init', 'show_more_visualcomposer');
