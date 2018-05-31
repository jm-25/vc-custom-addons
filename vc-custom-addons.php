<?php
/**
 * Plugin Name:       VC - Custom Addons
 * Description:       Custom elements for visual composer. 
 * Version:           1.0
 * Author:            Jorge Mejia
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/* ----------------------------- */
/* Required Files */
/* ----------------------------- */

require_once(dirname( __FILE__ ) . '/functions/shortcodes.php');
if (!function_exists('aq_resize')) {
	require_once(dirname( __FILE__ ) . '/functions/aq_resizer.php');
}
//Contact form 7
//require_once(dirname( __FILE__ ) . '/functions/send-all-fields.php');
//require_once(dirname( __FILE__ ) . '/functions/cmb2.php');
/* ----------------------------- */
/* Scritps & Styles */
/* ----------------------------- */

//Main script and style
 
function csm_main_scripts() {
	if (!is_admin()) {
/*
		$script_path = plugin_dir_path(__FILE__) . 'inc/scss/main.css';		
		$script_mtime = filemtime($style_path);		
*/
		wp_enqueue_script('pdm-main', plugin_dir_url(__FILE__) . 'inc/js/main-min.js', array('jquery'), 1.26, true);
		$style_path = plugin_dir_path(__FILE__) . 'inc/scss/main.css';		
		$style_mtime = filemtime($style_path);
		wp_enqueue_style('pdm-main', plugin_dir_url(__FILE__) . 'inc/scss/main.css', array(), $style_mtime , 'all');
	}
}
add_action( 'wp_enqueue_scripts', 'csm_main_scripts' ); 

