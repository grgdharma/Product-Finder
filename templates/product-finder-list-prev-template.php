<div id="tab-<?php echo $tab_index; ?>" class="tab-content current">
	<div class="pf-animate animate">
	<div class="row">
	 	<?php 
	        if($finder_data){
	            foreach ($finder_data as $cat) {
	            	$product_finder_cate_image = get_term_meta( $cat->term_id, 'image', true );
	                ?>
					<div class="col-md-3 col-sm-6 product-finder-product-cat">
						<div class="product-finder-product-cat-item">
		                    <?php 
		                        if($product_finder_cate_image){
		                            ?>
		                            <img src="<?php echo $product_finder_cate_image; ?>" >
		                            <?php
		                        }
		                    ?>
		                    <div class="product-finder-bottom">
		                    	<input class="chk" type="checkbox" id="box-<?php echo $cat->term_id; ?>" data-tab-index ="<?php echo $tab_index; ?>" data-name="<?php echo $cat->name; ?>" value="<?php echo $cat->term_id; ?>">
	  							<label for="box-<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></label> 
							</div>
						</div>
					</div>
	                <?php 
	            }
	        }
		?>
	</div>
</div>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {

			    $( ".chk" ).change(function() {
			    	var finder_id = $(this).val();
			    	var tab_index = $(this).data('tab-index') + 1;
				  	if ($(this).prop('checked')) {
						$.ajax({
							url: pf_ajax_url,
							type: 'post', 
							data:{action:'product_finder_action_more',tab_index:tab_index,finder_id:finder_id},
							beforeSend:function(xhr){
								$("#loading-overly").show();
	                    		$('#loading-overly').html('<img src='+pf_loader+'>');
							},
							complete: function() {
								$('#loading-overly').html('');
			                	$("#loading-overly").hide();
			                },
							success:function(data){
								$('#product-finder-response-data-list').html(data);
							}
						});
		    		}
		    		return false;
				}).change();
			});
		})(jQuery);
	</script>
</div>