<?php
/**
 * Frontend Script
 *
 * @author   Dharma Raj Gurung < gurungdrg30@gmail.com >
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
function product_finder_frontend_scripts() {

	// wp_enqueue_script('product-finder',PF_TEMPLATE_URL  . 'js/product-finder.js','','', true);
	// wp_enqueue_script('product-finder-main',PF_TEMPLATE_URL  . 'js/product-finder-main.js','','', true);
}
add_action('wp_enqueue_scripts', 'product_finder_frontend_scripts');

?>