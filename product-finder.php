<?php
/**
 * Plugin Name: Product Finder
 * Plugin URI: https://grgdharma.com
 * Description: WooCommerce product Finder
 * Version: 1.0
 * Author: Dharma Raj Gurung < gurungdrg30@gmail.com >
 * Author URI: https://grgdharma.com
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/****************************************
 Define PF_PLUGIN_FILE >> Product Finder
*****************************************/
if ( ! defined( 'PF_PLUGIN_FILE' ) ) {
	define( 'PF_PLUGIN_FILE', __FILE__ );
}
/********************
 Include main class
*********************/
if ( ! class_exists( 'PF_Finder' ) ) {
	
	include_once dirname( __FILE__ ) . '/includes/class-product-finder.php';
}
/****************
  Main instance 
*****************/
function PF() {
	return PF_Finder::instance();
}
/*****************
  Get PF Running.
******************/
PF();