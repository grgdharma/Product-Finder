<?php
/**
 * WCT Tabs Functions
 *
 * @author   Dharma Raj Gurung < gurungdrg30@gmail.com >
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'wp_ajax_product_finder_action', 'product_finder_action' );
add_action( 'wp_ajax_nopriv_product_finder_action', 'product_finder_action' );
function product_finder_action() {

	$finder_id = isset($_POST['finder_id']) ? $_POST['finder_id'] :0;
	$taxonomy = 'product_finder';

	$args = array(
        'taxonomy' => $taxonomy,
        'hide_empty' => '0',
        'parent' => $finder_id,
        'orderby' => 'id',
        'order' => 'ASC'
    );
	$finder_data = get_categories($args);
	// information
	$term_info = get_term_by( 'id', $finder_id, $taxonomy ); 
	$term_id = $term_info->term_id;
	$term_description = get_term_meta( $term_id, 'pf_short_desc', true ); 
	if(count($finder_data) > 0){

		$children = PF()->get_pf_hierarchy($taxonomy,$finder_id);
		$count_child = PF()->children_count($children);
		
		do_action( 'product_finder_list',$term_id,$term_description, $finder_data,$count_child);
		
	}else{
		do_action( 'product_list',$finder_id);
	}
	exit();
}

add_action( 'wp_ajax_product_finder_action_more', 'product_finder_action_more' );
add_action( 'wp_ajax_nopriv_product_finder_action_more', 'product_finder_action_more' );
function product_finder_action_more() {
	$finder_id = isset($_POST['finder_id']) ? $_POST['finder_id'] :0;
	$taxonomy = 'product_finder';
	$args = array(
        'taxonomy' => $taxonomy,
        'hide_empty' => '0',
        'parent' => $finder_id,
        'orderby' => 'id',
        'order' => 'ASC'
    );
	$finder_data = get_categories($args);
	$tab_index = $_POST['tab_index'];
	// information
	$term_info = get_term_by( 'id', $finder_id, $taxonomy ); 
	$term_id = $term_info->term_id;
	$term_description = get_term_meta( $term_id, 'pf_short_desc', true ); 
		
	if(count($finder_data) > 0){
		do_action( 'product_finder_list_more',$term_id,$term_description,$tab_index,$finder_data);
	}else{
		do_action( 'product_list',$tab_index,$finder_id);
	}
	exit();
}

add_action( 'wp_ajax_product_finder_action_prev', 'product_finder_action_prev' );
add_action( 'wp_ajax_nopriv_product_finder_action_prev', 'product_finder_action_prev' );
function product_finder_action_prev() {
	$finder_id = isset($_POST['finder_id']) ? $_POST['finder_id'] :0;
	$taxonomy = 'product_finder';
	$args = array(
        'taxonomy' => $taxonomy,
        'hide_empty' => '0',
        'parent' => $finder_id,
        'orderby' => 'id',
        'order' => 'ASC'
    );
	$finder_data = get_categories($args);
	$tab_index = $_POST['tab_index'];
	// information
	$term_info = get_term_by( 'id', $finder_id, $taxonomy ); 
	$term_id = $term_info->term_id;
	$term_description = get_term_meta( $term_id, 'pf_short_desc', true ); 
		
	if(count($finder_data) > 0){
		
		do_action( 'product_finder_list_prev',$term_id,$term_description,$tab_index,$finder_data);
	}
	exit();
}