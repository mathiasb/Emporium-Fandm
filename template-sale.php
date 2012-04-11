<?php
/*
Template Name: Sale
*/
?>
<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div class="row visible">
					
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<?php woo_breadcrumbs(); ?>
		<?php } ?>  
		
		<section id="content" class="woocommerce" role="content">

	        <div id="sale">
	        
			    <h1 class="title"><?php the_title(); ?></h1>
	        	
	        	<?php the_content(); ?>
	        	
	        	<?php
	        		global $wp_query, $woocommerce;
	        		
	        		// Get products on sale
	        		$meta_query = array();
					$meta_query[] = $woocommerce->query->visibility_meta_query();
				    $meta_query[] = $woocommerce->query->stock_status_meta_query();
				    $meta_query[] = array(
				    	'key' => 'sale_price',
				        'value' 	=> 0,
        				'compare' 	=> '>',
        				'type'		=> 'NUMERIC'
				    );
	    
	        		$on_sale = get_posts(array(
	        			'post_type' 		=> array('product', 'product_variation'),
	        			'posts_per_page' 	=> -1,
	        			'post_status' 		=> 'publish',
	        			'meta_query' 		=> $meta_query,
	        			'fields' 			=> 'id=>parent'
	        		));
	        		
	        		$product_ids_on_sale = array_unique(array_merge(array_values($on_sale), array_keys($on_sale)));

					// Main query for loop
					query_posts(array_merge($wp_query->query, $woocommerce->query->get_catalog_ordering_args(), array(
						'pagename' 			=> '',
						'post_type'			=> 'product',
						'posts_per_page'	=> apply_filters('loop_shop_per_page', get_option('posts_per_page')),
						'post__in'			=> $product_ids_on_sale
					)));
	        	
	        		woocommerce_get_template_part( 'loop', 'shop' ); 
	        		
	        		do_action('woocommerce_pagination');
	        		
	        		wp_reset_query();
	        	?>			    		
	    						
	        </div><!-- /.post -->                    
	                
        </section><!-- /#content -->

        <?php get_sidebar(); ?>

    </div><!-- /.row -->
		
<?php get_footer(); ?>
