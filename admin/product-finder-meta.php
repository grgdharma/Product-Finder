<?php 

/**
 * Adding Meta Field
 * @return void 
*/
add_action( 'product_finder_add_form_fields', 'pf_add_meta', 10, 2 );
function pf_add_meta( $term ) {
	wp_enqueue_media();
	?>
	<div class="form-field">
		<label><?php _e( 'Short Description'); ?></label>
		<textarea style="width:100%;" name="pf_short_desc" > </textarea>
	</div>
	<?php
}

/**
 * Edit Image Field
 * @return void 
 */
add_action( 'product_finder_edit_form_fields', 'pf_edit_meta', 10 );
function pf_edit_meta( $term ) {
	wp_enqueue_media();
	$t_id = $term->term_id;
	$pf_short_desc = get_term_meta( $t_id, 'pf_short_desc', true ); 
	?>
	<tr class="form-field">
		<th><label><?php _e( 'Short Description'); ?></label></th>
		<td><textarea style="width:100%;" name="pf_short_desc" > <?php echo esc_attr( $pf_short_desc ) ? esc_attr( $pf_short_desc ) : ''; ?> </textarea></td>
	</tr>
<?php
}
/**
 * Saving Image
 */
add_action( 'edited_product_finder', 'pf_save_meta' );  
add_action( 'create_product_finder', 'pf_save_meta' );
function pf_save_meta( $term_id ) {
	if ( isset( $_POST['pf_short_desc'] ) ) {
		$pf_short_desc = $_POST['pf_short_desc'];
		update_term_meta( $term_id, 'pf_short_desc', $pf_short_desc );
	} 	
}  


?>