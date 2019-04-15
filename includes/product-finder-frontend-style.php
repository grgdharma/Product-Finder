<?php
/**
 *
 * @author   Dharma Raj Gurung < gurungdrg30@gmail.com >
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/* ----------------------------------------
* load CSS
----------------------------------------- */

function product_finder_frontend_styles() {

	wp_enqueue_style('product-finder', PF_TEMPLATE_URL .'css/product-finder-styles.css');
	wp_enqueue_style('product-finder-responsive', PF_TEMPLATE_URL .'css/product-finder-responsive-styles.css');
}

add_action( 'wp_enqueue_scripts', 'product_finder_frontend_styles' );
