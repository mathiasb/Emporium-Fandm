<?php get_header(); ?>	
<?php global $woo_options; ?>

<div class="row homepage visible">

	<!-- Header widget -->
			
	<section class="header-widget">
		<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'header-widget' ); ?>
	</section><!--/.header-widget-->

	<section id="content">
	
		<?php
			if ( isset( $woo_options['woo_slider'] ) && $woo_options['woo_slider'] == 'true' ) {		
				// Load the slider.
				get_template_part( 'includes/slider' );
			}
		?>
		
		<!-- The featured products -->
		
		<?php if ( $woo_options[ 'woo_homepage_featured_products' ] == "true" ) { ?>
		
		<ul class="featured-products">
				
		<?php
		$i = 0;
		$featured_products_per_page = get_option('woo_homepage_featured_products_number');
		$args = array( 'post_type' => 'product', 'posts_per_page' => $featured_products_per_page, 'meta_key' => 'featured', 'meta_value' => 'yes' );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post(); $_product = &new woocommerce_product( $loop->post->ID ); ?>
				
				<li class="<?php $i++; if( 4 == $i ) { $i = 0; echo 'last'; }?>">
					
					<?php // woocommerce_show_product_sale_flash( $post, $_product ); ?>
					
					<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php // echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
						<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_single'); else echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_single_image_width').'px" height="'.$woocommerce->get_image_size('shop_single_image_height').'px" />'; ?>
					</a>
					
					<h2><a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php // echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?> <span class="featured-price"><?php echo $_product->get_price_html(); ?></span></a></h2>
				
					<?php // woocommerce_template_loop_add_to_cart( $loop->post, $_product ); ?>
					
				</li>
			
		<?php endwhile; ?>
		
		</ul><!--/.featured-1-->
		
		<?php } else { ?>
		        	
		<?php } ?>
		
		<div class="col2-set">
		
			<div class="col-1 recent-products">
			
				<?php if ( $woo_options[ 'woo_homepage_recent_products' ] == "true" ) { ?>
				
				<!-- recent products -->
				
				<ul class="recent products">
				
					<?php
					$i = 0;
					$products_per_page = get_option('woo_homepage_recent_products_number');
					$args = array( 'post_type' => 'product', 'posts_per_page' => $products_per_page, 'meta_key' => 'featured', 'meta_value' => 'no' );
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); $_product = &new woocommerce_product( $loop->post->ID ); ?>
					
						<li class="product <?php $i++; if( 3 == $i ) { $i = 0; echo 'last'; }?>">
						
							<div class="img-wrap">
								<span class="price"><?php echo $_product->get_price_html(); ?></span>
								<?php woocommerce_show_product_sale_flash( $post, $_product ); ?>
								<a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php // echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>">
									<?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_thumbnail'); else echo '<img src="'.$woocommerce->plugin_url().'/assets/images/placeholder.png" alt="Placeholder" width="'.$woocommerce->get_image_size('shop_catalog_image_width').'px" height="'.$woocommerce->get_image_size('shop_catalog_image_height').'px" />'; ?>
								</a>
							</div>
							
							<div class="meta">
							
								<h3><a href="<?php echo get_permalink( $loop->post->ID ) ?>" title="<?php // echo esc_attr($loop->post->post_title ? $loop->post->post_title : $loop->post->ID); ?>"><?php the_title(); ?></a></h3>
								
								<?php woocommerce_template_loop_add_to_cart( $loop->post, $_product ); ?>
							
							</div><!--/.meta-->
						
						</li>
					<?php endwhile; ?>
				
				</ul><!--/ul.recent-->
				
				<?php } else { ?>
		        	
				<?php } ?>				
				
			</div><!--/.recent-products-->
			
			<div class="col-2 recent-posts">
			
				<!-- Display the latest post -->
	
				<?php if ( $woo_options[ 'woo_homepage_content' ] == "true" ) { ?>
											
				<?php 
				$posts_per_page = get_option('woo_homepage_content_number');
				$args = array( 'posts_per_page' => $posts_per_page );
				query_posts($args);
				?>
				
				<?php while (have_posts()) : the_post(); ?>
				
					<article <?php post_class(); ?>>
					
						<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						
						<section class="article-content">
							
							<?php the_excerpt(); ?>  
						
						</section><!--/.article-content-->
						
						<aside class="meta">
						
							<ul>
								<li class="date"><?php the_time('j F Y', '<time>', '</time>'); ?></li>
								<li class="author"><?php the_author_posts_link(); ?></li>
								<li class="category"><?php the_category(', '); ?></li>
								<!--<li class="tags"><?php // the_tags('Tagged: ',', ',''); ?></li>-->
								<li class="comments"><?php comments_popup_link(__( '0 Comments', 'woothemes' ), __( '1 Comment', 'woo themes' ), __( '% Comments', 'woothemes' )); ?></li>
								<?php the_tags( '<li class="tags">', ', ', '</li>' ); ?>
							</ul>
						
						</aside><!--/.meta-->
					
					</article><!--/.post-->
				
				<?php endwhile;?>
				
				<?php } else { ?>
		        	
		        <?php } ?>
			
				<!-- Display the homepage widget area -->
			
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar( 'homepage-content' ); ?>
			
			</div>
		
		</div><!--/.col2-set-->
			
	
	</section>
	
</div>

<?php get_footer(); ?>