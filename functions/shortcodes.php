<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

//include_once(dirname(dirname(__FILE__)) . '/shortcodes/wc_product_popup/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/child-pages/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/surfmex-map/shortcode.php');
include_once(dirname(dirname(__FILE__)) . '/shortcodes/image-text/shortcode.php');
include_once(dirname(dirname(__FILE__)) . '/shortcodes/c_google_map_multiple/shortcode.php');
include_once(dirname(dirname(__FILE__)) . '/shortcodes/c_google_map/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/sm_bg_image/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/sm_grid_gallery/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/sm_carousel/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/sm_carousel_team/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/sm_section_title/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/sm_button/shortcode.php');
include_once(dirname(dirname(__FILE__)) . '/shortcodes/slick_carousel/shortcode.php');
include_once(dirname(dirname(__FILE__)) . '/shortcodes/expandable_element/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/cc_quick_portfolio_grid/shortcode.php');
include_once(dirname(dirname(__FILE__)) . '/shortcodes/header_slider/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/custom_google_map/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/vc_blocks/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/bgcm_programs/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/vc_testimonial/shortcode.php');
//include_once(dirname(dirname(__FILE__)) . '/shortcodes/bgcm_programs/shortcode.php');


// Hover image core function
function himage($atts, $content)
{
	$trans_time = get_option("trans_time")."s";
	$trans_delay = get_option("trans_delay")."s";
	$trans_timing = get_option("trans_timing");
	
	$style = "<style>\n.himage\n{\n\t-webkit-transition: opacity ".$trans_time." ".$trans_timing." ".$trans_delay.";\n\t-moz-transition: opacity ".$trans_time." ".$trans_timing." ".$trans_delay.";\n\t-o-transition: opacity ".$trans_time." ".$trans_timing." ".$trans_delay.";\n\ttransition: opacity ".$trans_time." ".$trans_timing." ".$trans_delay.";\n}\n</style>";
	$aArr = explode("<", $content);
	$aArr = explode(">", $aArr[1]);
     $beforeString = "";
     $afterString = "";
     $aString = $aArr[0];
     $aStringArr = str_split($aString);
     if($aStringArr[0] == "a")
     {
		$beforeString = "<".$aArr[0].">";
		$afterString = "</a>";
	}
	$values = explode(" ", $content);
	$srcArr = array();
	foreach($values as $i)
	{
		$arrArr = explode("=\"", $i);
		if($arrArr[0] == "src")
		{
			array_push($srcArr, str_replace("\"", "", str_replace("src=\"", "", $i)));
		}
	}
	$widthArr = array();
	foreach($values as $j)
	{
		$arrArr = explode("=\"", $j);
		if($arrArr[0] == "width")
		{
			array_push($widthArr, str_replace("\"", "", str_replace("width=\"", "", $j)));
		}
	}
	$heightArr = array();
	foreach($values as $k)
	{
		$arrArr = explode("=\"", $k);
		if($arrArr[0] == "height")
		{
			array_push($heightArr, str_replace("\"", "", str_replace("height=\"", "", $k)));
		}
	}
     $imgTag = "<div style=\"position:relative;\">".$beforeString."<img src=\"".$srcArr[1]."\" width=\"".$widthArr[1]."\" height=\"".$heightArr[1]."\" /><img class=\"himage\" src=\"".$srcArr[0]."\" width=\"".$widthArr[0]."\" height=\"".$heightArr[0]."\" onmouseover=\"this.style.opacity=0;\" onmouseout=\"this.style.opacity=1;\" style=\"position:absolute; top:0; left:0;\" />".$afterString."</div>";
	return $imgTag;
}
add_shortcode("himage", "himage");





