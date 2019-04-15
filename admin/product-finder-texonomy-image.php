<?php 

/**
 * Adding Image Field
 * @return void 
*/
add_action( 'product_finder_add_form_fields', 'pf_add_image', 10, 2 );
function pf_add_image( $term ) {
	wp_enqueue_media();
	?>
	<div class="form-field">
		<label for="taxImage"><?php _e( 'Thumbnail', 'yourtextdomain' ); ?></label>
		<input style="width:100%;" type="text" id="add-category-img" name="taxImage" id="taxImage">
		<input type="button"  class="button" value="Upload/Add Image" onclick="add_category_file(this)" />
		<p class="description">Use <strong>get_term_meta( $term_id, 'image', true )</strong> to display in frontend.</p>
		<script type="text/javascript">
	        // Add Media file
	        function add_category_file(obj) {
	        	var fileFrame = wp.media.frames.file_frame = wp.media({
	            	multiple: false
	        	});
	        	fileFrame.on('select', function() {
	            	var url = fileFrame.state().get('selection').first().toJSON();
	            	jQuery('#add-category-img').val(url.url);
	            });
	            fileFrame.open();
	        };
	    </script>
	    <style type="text/css">
	    	body table.wp-list-table .column-pf_thumb {
	    		width: 52px !important;
		    	text-align: center;
			    white-space: nowrap;
			}
	    </style>
	</div>
	<?php
}

/**
 * Edit Image Field
 * @return void 
 */
add_action( 'product_finder_edit_form_fields', 'pf_edit_image', 10 );
function pf_edit_image( $term ) {
	wp_enqueue_media();
	// put the term ID into a variable
	$t_id = $term->term_id;
	$term_image = get_term_meta( $t_id, 'image', true ); 
	?>
	<tr>
		<td></td>
		<td><img style="max-width: 50%;" src="<?php echo esc_attr( $term_image ) ? esc_attr( $term_image ) : ''; ?>"></td>
	</tr>
	<tr class="form-field">
		<th><label for="taxImage"><?php _e( 'Thumbnail', 'yourtextdomain' ); ?></label></th>
		<td><input style="width:100%;" type="text" id="edit-category-img"  name="taxImage" id="taxImage" value="<?php echo esc_attr( $term_image ) ? esc_attr( $term_image ) : ''; ?>"></td>
		<td><input type="button" class="button" value="Upload/Add Image" onclick="add_category_file(this)" /></td>
	</tr>
	<script type="text/javascript">
        // Add Media file
        function add_category_file(obj) {
        	var fileFrame = wp.media.frames.file_frame = wp.media({
            	multiple: false
        	});
        	fileFrame.on('select', function() {
            	var url = fileFrame.state().get('selection').first().toJSON();
            	jQuery('#edit-category-img').val(url.url);
            });
            fileFrame.open();
        };
    </script>
<?php
}
/**
 * Saving Image
 */
add_action( 'edited_product_finder', 'pf_save_image' );  
add_action( 'create_product_finder', 'pf_save_image' );
function pf_save_image( $term_id ) {
	if ( isset( $_POST['taxImage'] ) ) {
		$term_image = $_POST['taxImage'];
		update_term_meta( $term_id, 'image', $term_image );
	} 	
}  


add_filter( 'manage_edit-product_finder_columns', 'product_finder_columns');
add_filter( 'manage_product_finder_custom_column', 'product_finder_column' , 10, 3 );
/**
 * Thumbnail column added to finder admin.
 *
 * @param mixed $columns
 * @return array
 */
function product_finder_columns( $columns ) {
	$new_columns = array();
	if ( isset( $columns['cb'] ) ) {
		$new_columns['cb'] = $columns['cb'];
		unset( $columns['cb'] );
	}
	$new_columns['pf_thumb'] = __( 'Image', 'woocommerce' );
	$columns = array_merge( $new_columns, $columns );
	return $columns;
}
/**
 * Thumbnail column value added to finder admin.
 *
 * @param string $columns
 * @param string $column
 * @param int    $id
 *
 * @return string
 */
function product_finder_column( $columns, $column, $id ) {
	if ( 'pf_thumb' === $column ) {
		if (get_term_meta( $id, 'image', true )) {
			$image = get_term_meta( $id, 'image', true );
		} else {
			$image = wc_placeholder_img_src();
		}
		$image    = str_replace( ' ', '%20', $image );
		$columns .= '<img src="' . esc_url( $image ) . '" class="wp-post-image" height="48" width="48" />';
	}
	return $columns;
}

?>