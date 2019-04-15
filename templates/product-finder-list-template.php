
	
		<ul class="tabs">
			<?php 
			for ($i=1; $i < $count_child+2; $i++) { 
				if($i==1){
					$current = 'current';
				}else{
					$current = '';
				}
				?>
				<li class="tab-link <?php echo $current; ?>" data-tab-number="<?php echo $i;?>" data-tab="tab-<?php echo $i;?>">
					<div class=" animate">
						<span> <?php echo $i;?></span> <span class="tab-title"> </span>
					</div>	 
				</li>
				<?php
			}
			?>
			<li class="tab-link" data-tab="tab-last"><span> <strong>√</strong></span> <span class="tab-title"></span> </li>
		</ul>
		<div id="product-finder-response-data-list">
			<!-- <div id="loading-overly"></div> -->
			<div id="tab-1" class="tab-content current ">
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
					                    	<input class="chk" type="checkbox" id="box-<?php echo $cat->term_id; ?>" data-tab-index ="1" data-name="<?php echo $cat->name; ?>" value="<?php echo $cat->term_id; ?>">
				  							<label for="box-<?php echo $cat->term_id; ?>"><?php echo $cat->name; ?></label> 
										</div>
									</div>
								</div>
				                <?php 
				            }
				        }else{
				        	echo "string";
				        }
					?>
				</div>
				</div>
			</div>
			<script type="text/javascript">
				(function($) {
					$(document).ready(function() {
						var term_id = "<?php echo $term_id; ?>";
						var term_description = "<?php echo $term_description; ?>";
						$('.tabs .tab-link.current').attr("data-finder-id",term_id);
						$('.tabs .tab-link.current .tab-title').html(term_description);
					    

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
										//return false;
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
	

<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$(".tab-link").on("click",function(){

				$(".tabs .tab-link").removeClass('current');
				$(".tabs .tab-link").find('.tab-title').css("display",'none');
				
				$(this).addClass('current'); 
				$(this).removeAttr("style");
				$(this).find('.tab-title').css("display",'block');

				var tab_id = $(this).attr('data-finder-id');
				var tab_number = $(this).attr('data-tab-number');

				$.ajax({
					url: pf_ajax_url,
					type: 'post', 
					data:{action:'product_finder_action_prev',tab_index:tab_number,finder_id:tab_id},
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
			});
		});	
	})(jQuery);
</script>
