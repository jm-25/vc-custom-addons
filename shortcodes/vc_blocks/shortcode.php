<?php 
include_once(dirname(__FILE__) . '/post-types/vc_block.php');
include_once(dirname(__FILE__) . '/taxonomies/block-category.php');

//route single- template
function tb_location_single($single_template){
  global $post;
  $found = locate_template('single-vc_block.php');
  if($post->post_type == 'vc_block' && $found == ''){
    $single_template = dirname(__FILE__).'/post-types/templates/single.php';
  }
  return $single_template;
}

add_filter('single_template','tb_location_single');

	
function vc_blocks( $atts, $content = null ) {
	    extract(shortcode_atts(array(
	       	'block' 	=> ''     	
	    ), $atts));
	  if ($block){  
	    ob_start(); ?>
			<?php $the_query = new WP_Query( array( 'post_type' => 'vc_block', 'p' => $block ) ); ?>
			<?php if ( $the_query->have_posts() ) : ?>
				<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			    
			<?php
			$out .= ob_get_clean();
			return $out;
		}
}
add_shortcode('vc_blocks', 'vc_blocks');


add_action('init', 'vc_blocks_visualcomposer');
function vc_blocks_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) { // or using plugins path function
		return;
	}

$query = new WP_Query( array( 'post_type' => 'vc_block', 'posts_per_page' => -1 ) );
$posts = $query->posts;
$blocks['Choose'] = '';

foreach($posts as $post) {
	$terms = get_the_terms( $post->ID, 'block_category' );
	$terms_array = "";
	$terms_lable = "";
 if ($terms){
	foreach($terms as $term) {
		$terms_array[]=$term->name;
	}
	$terms_lable = implode("-", $terms_array)." -> ";
 }
	
	
	$blocks[$terms_lable.$post->post_title] = $post->ID;
}
	
	vc_map( array(
		"name" => __("VC Block"),
		"base" => "vc_blocks",
		//"icon" => plugins_url( 'icon.png', __FILE__ ),
		"category" => "Theme elements",
		"params" => array(
/*
			array(
			  "type" => "textfield",
			  "heading" => __("Product ID"),
			  "param_name" => "id",
			  "admin_label" => true,
			  "description" => __("Enter the product ID")
			),
			array(
			  "type" => "textfield",
			  "heading" => __("Button Label"),
			  "param_name" => "label",
			  "admin_label" => true,
			  "description" => __("Example: Book Now")
			),
*/
			array(
				"type" => "dropdown",
				"heading" => __("Block"),
				"param_name" => "block",
				"admin_label" => true,
				"description" => __("Choose a VC Block from dropdown"),
		  	"value" => $blocks
			),					
		)
	) );
	
	
	
}






