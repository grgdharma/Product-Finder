<?php 

add_action( 'init', 'create_pf_taxonomy');
function create_pf_taxonomy() {

	$object = array('product');
	$labels = array(
	    'name' => _x('Product Finder', 'taxonomy general name'),
	    'singular_name' => _x('Product Finder', 'taxonomy singular name'),
	    'search_items' => __('Search Product Finder'),
	    'all_items' => __('All Product Finder'),
	    'parent_item' => __('Parent'),
	    'parent_item_colon' => __('Parent'),
	    'edit_item' => __('Edit'),
	    'update_item' => __('Update'),
	    'add_new_item' => __('Add New '),
	    'new_item_name' => __('New Product Finder Name'),
	    'menu_name' => __('Product Finder'),
	);
	$args = array(
	    "hierarchical" => true,
	    "labels" => $labels,
	    'public' => true,
	    "show_ui" => true,
	    "query_var" => true,
	    'rewrite' => array(
	        'slug' => 'product_finder', 
	        'with_front' => false, 
	        'hierarchical' => true 
	    )
	);
	register_taxonomy('product_finder', $object, $args);
}



?>