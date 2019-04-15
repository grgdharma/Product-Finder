<div id="tab-last" class="tab-content current">
    <div class="padding-top">
        <div class="pf-animate animate">
        
    	<?php 
    		$args = array(
                'posts_per_page' => -1,
                'tax_query' => array(
                    'relation' => 'AND',
                    array(
                        'taxonomy' => 'product_finder',
                        'field' => 'term_id',
                        'terms' => $finder_id
                    )
                ),
                'post_type' => 'product',
                'orderby' => 'title,'
            );
            $products = new WP_Query( $args );
            if($products->have_posts()){
                ?>
                <div class="row">
                <?php
                while ( $products->have_posts() ) {
                    $products->the_post();
                    global $product;
                    ?>
                        <div class="item col-md-3 col-sm-6">
                            <div class="products-entry">
                                <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
                                <div class="products-thumb">
                                    <?php
                                        /**
                                         * woocommerce_before_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                                         */
                                        do_action( 'woocommerce_before_shop_loop_item_title' );
                                        /**
                                         * woocommerce_after_shop_loop_item hook
                                         *
                                         * @hooked woocommerce_template_loop_add_to_cart - 10
                                         */
                                        do_action( 'woocommerce_after_shop_loop_item' );
                                    ?>
                                </div>
                                <div class="products-content text-center plugin-content">
                                    <?php
                                        /**
                                         * woocommerce_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_template_loop_product_title - 10
                                         */
                                        do_action( 'woocommerce_shop_loop_item_title' );

                                        /**
                                         * woocommerce_after_shop_loop_item_title hook
                                         *
                                         * @hooked woocommerce_template_loop_rating - 5
                                         * @hooked woocommerce_template_loop_price - 10
                                         */
                                        do_action( 'woocommerce_after_shop_loop_item_title' );
                                    ?>
                                    <?php
                                        /**
                                         * woocommerce_after_shop_loop_item hook
                                         *
                                         * @hooked woocommerce_template_loop_add_to_cart - 10
                                         */
                                        do_action( 'woocommerce_after_shop_loop_item' );
                                    ?>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?> </div> <?php
            }else{
                ?><div class="">
                    <?php
                    echo "nicht gefunden";
                    ?>
                </div>
                <?php
                
            }
    	?>
        
    </div>
    </div>

</div>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $('.tabs .current').next().addClass('current');  
            $('.tabs .current').prev().removeClass("current");  
            $('.tabs .current').prev().addClass("click-enable");     
            // inline
            $('.tabs .current').prev().find('.tab-title').css("display","none");                  
        });
    })(jQuery);
</script>