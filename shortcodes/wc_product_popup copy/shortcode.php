<?php function wc_product_popup( $atts, $content = null ) {

    static $done = array(); // this array contains product id

	    extract(shortcode_atts(array(
	       	'id' 	=> '',
	       	'size'=>'large',     	
	       	'align'=>'center',     	
	       	'label'=>'Book Now'     	
	    ), $atts));


		//Lets place the button	
    ob_start(); ?>
    
			<div class="text-<?php echo $align ?>">	<a href="#popup_product<?php echo $id ?>" class="popup-product button  btn-<?php echo $size ?>"><?php echo $label ?></a></div>  
  
		<?php $out = ob_get_clean();


    if (in_array($id, $done)) { // if this id is already in the array do not duplicate add to cart form 
    	return $out;
    }

    if ( is_singular() ){ //Place hidden add to cart form
			$product_data = get_post( $id );
			$product = wc_setup_product_data( $product_data );
			
			if ( ! $product ) {
				return '';
			}
			global $post, $woocommerce, $product;
			
			//Lets place the add to cart form
			//$excerpt = ($product->post->post_excerpt ?	$product->post->post_excerpt : $product->post->post_content);
			$excerpt = apply_filters('the_content', $product->post->post_excerpt);
			$content = apply_filters('the_content', $product->post->post_content);
			
			ob_start();
			?>
				<div id="popup_product<?php echo $id ?>" class="product-popup mfp-hide">
					<h2><?php echo $product->get_title() ?></h2>
					<div class="intro"><?php echo $excerpt ?></div>
					<div class="price"><?php echo get_woocommerce_currency_symbol(); echo $product->get_price() ?></div>
					<?php woocommerce_template_single_add_to_cart() ?>
					<div class="description"><?php echo $content ?></div>
				</div>
			<?php
			// Restore Product global in case this is shown inside a product post
			wc_setup_product_data( $post );						
			$out .= ob_get_clean();
      $done[] = $id; // add id to array one form is placed    
    }
    
    wp_enqueue_script( 'magnific_popup' );
		wp_enqueue_style( 'magnific_popup' );
    
     return $out;
}
add_shortcode('wc_product_popup', 'wc_product_popup');




add_action('init', 'wc_product_popup_visualcomposer');
function wc_product_popup_visualcomposer() {
	if (!class_exists('WPBakeryVisualComposerAbstract')) { // or using plugins path function
		return;
	}
  
	$prefix = 'csm_';
	
	// Woocommerce Popup Button Shortcode
	vc_map( array(
		"name" => __("Woocommerce Popup Button"),
		"base" => "wc_product_popup",
		"icon" => plugins_url( 'icon.png', __FILE__ ),
		//"class" => "thb_vc_sc_gap",
		"category" => "Theme elements",
		"params" => array(
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
			array(
				"type" => "dropdown",
				"heading" => __("Button Size"),
				"param_name" => "size",
				"admin_label" => true,
		  	"value" => array(
		  		"Small" => "small",
		  		"Medium" => "medium",
		  		"Large" => "large",
		  		"Xlarge" => "xlarge"
		  	)
			),
			array(
				"type" => "dropdown",
				"heading" => __("Choose Aligment"),
				"param_name" => "align",
				"admin_label" => true,
		  	"value" => array(
		  		"Left" => "left",
		  		"Right" => "right",
		  		"Center" => "center"
		  	)
			),						
		)
	) );
	
	
	
}






