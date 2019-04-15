<?php 
/*********************************************
  Get the product_finder_template template.
 *********************************************/
if ( ! function_exists( 'product_finder_template' ) ) {
    function product_finder_template() {
        include_once( PF_ABSPATH . 'templates/product-finder-template.php' );
    }
}

if ( ! function_exists( 'product_finder_list_template' ) ) {
    function product_finder_list_template($term_id,$term_description,$finder_data,$count_child) {
        include_once( PF_ABSPATH . 'templates/product-finder-list-template.php' );
    }
}
if ( ! function_exists( 'product_finder_list_more_template' ) ) {
    function product_finder_list_more_template($term_id,$term_description,$tab_index,$finder_data) {
        include_once( PF_ABSPATH . 'templates/product-finder-list-more-template.php' );
    }
}

if ( ! function_exists( 'product_finder_list_prev_template' ) ) {
    function product_finder_list_prev_template($term_id,$term_description,$tab_index,$finder_data) {
        include_once( PF_ABSPATH . 'templates/product-finder-list-prev-template.php' );
    }
}
if ( ! function_exists( 'product_list_template' ) ) {
    function product_list_template($tab_index,$finder_id) {
        include_once( PF_ABSPATH . 'templates/product-list-template.php' );
    }
}