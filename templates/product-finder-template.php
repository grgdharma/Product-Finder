<div id="product-finder-first-page" >
	<div class="row product-finder-product_cat-lists">

        <div id="loading-overly"></div>
        <div id="product-finder-response-data" class="col-md-12">
        	
			<div class="col-md-3 col-sm-6">
			 	<?php 
				 	$args = array(
				        'taxonomy' => 'product_finder',
				        'hide_empty' => '0',
				        'parent' => 0,
				        'orderby' => 'id',
				        'order' => 'ASC'
				    );
					$finder_data = get_categories($args);
			        if($finder_data){
			            foreach ($finder_data as $cat) {
	                        $product_finder_cate_image = get_term_meta( $cat->term_id, 'image', true );
			                ?>
							<div class="product-finder-product-cat">
								<div class="product-finder-product-cat-item">
				                    <?php 
				                        if($product_finder_cate_image){
				                            ?>
				                            <img src="<?php echo $product_finder_cate_image; ?>" >
				                            <?php
				                        }
				                    ?>
				                    <div class="product-finder-bottom">
				                    	<input class="chk" type="checkbox" id="box-<?php echo $cat->term_id; ?>" data-name="<?php echo $cat->name; ?>" value="<?php echo $cat->term_id; ?>">
			  							<label for="box-<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></label> 
									</div>
								</div>
							</div>
			                <?php 
			            }
			        }
				?>
			</div>
			
			<script type="text/javascript">
				(function($) {
					$(document).ready(function() {
					    $( ".chk" ).change(function() {
					    	var finder_id = $(this).val();
						  	if ($(this).prop('checked')) {
								$.ajax({
									url: pf_ajax_url,
									type: 'post', 
									data:{action:'product_finder_action',finder_id:finder_id},
									beforeSend:function(xhr){
										$("#loading-overly").show();
			                    		$('#loading-overly').html('<img src='+pf_loader+'>');
										//return false;
									},
									complete: function() {
										$('#loading-overly').html('');
					                	$("#loading-overly").hide();
					                },
									success:function(data){
										$('#product-finder-response-data').html(data);
									}
								});
								return false;
				    		}
						}).change();
					});
				})(jQuery);
			</script>
		</div>
	</div>
</div>
