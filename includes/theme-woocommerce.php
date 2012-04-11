<?php
/*-----------------------------------------------------------------------------------*/
/* Any WooCommerce overrides can be found here
/*-----------------------------------------------------------------------------------*/

// Disable WooCommerce styles 
define('WOOCOMMERCE_USE_CSS', false);

// Change columns in product loop to 4
function loop_columns() {
	return 4;
}
add_filter('loop_shop_columns', 'loop_columns');

// Display 16 products per page
add_filter('loop_shop_per_page', create_function('$cols', 'return 16;'));

// Remove the add to cart button from the product loop
//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10, 2);

// Move the price in the product loop markup
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10, 2);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 7, 2);

// Adjust markup on all woocommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action( 'woocommerce_before_main_content', 'woocommerce_wrapper', 10);
add_action( 'woocommerce_after_main_content', 'woocommerce_close_wrapper', 10); 

if (!function_exists('woocommerce_wrapper')) {
	function woocommerce_wrapper(){
		echo '<section id="content" role="content">';
	}
}

if (!function_exists('woocommerce_close_wrapper')) {
	function woocommerce_close_wrapper() {
		echo '</section>';
	}
}

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
add_action( 'woocommerce_before_main_content', 'woocommerceframework_breadcrumb', 01, 0);

if (!function_exists('woocommerceframework_breadcrumb')) {
	function woocommerceframework_breadcrumb() {
		global  $woo_options;
		if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) {
			woo_breadcrumbs();
		}
	}
}

// Remove pagination (we're using the WooFramework default pagination)
remove_action( 'woocommerce_pagination', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_pagination', 'woocommerceframework_pagination', 10 );

function woocommerceframework_pagination() {
	if ( is_search() && is_post_type_archive() ) {
		add_filter( 'woo_pagination_args', 'woocommerceframework_add_search_fragment', 10 );
	}
	woo_pagenav();
}

function woocommerceframework_add_search_fragment ( $settings ) {
	$settings['add_fragment'] = '?post_type=product';
	return $settings;
} // End woocommerceframework_add_search_fragment()

// Remove sidebar on single shop pages
//add_action('wp', create_function("", "if (is_singular(array('product'))) remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);") );

// Remove sidebar on shop archive pages
//add_action('wp', create_function("", "if (is_archive(array('product'))) remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);") );


// Change columns in related products output to 3 and move below the product summary 
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20);

if (!function_exists('woocommerce_output_related_products')) {
	function woocommerce_output_related_products() {
	    woocommerce_related_products(3,3); // 3 products, 3 columns
	}
}

// Change columns in upsells output to 3 and move below the product summary
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display');
add_action( 'woocommerce_after_single_product', 'woocommerceframework_upsell_display', 20);
 
if (!function_exists('woocommerceframework_upsell_display')) {
	function woocommerceframework_upsell_display() {
	    woocommerce_upsell_display(3,3); // 3 products, 3 columns
	}
}

// Adjust the star rating in the sidebar
add_filter('woocommerce_star_rating_size_sidebar', 'woostore_star_sidebar');

if (!function_exists('woostore_star_sidebar')) {
	function woostore_star_sidebar() {
		return 12;
	}
}

// Adjust the star rating in the recent reviews
add_filter('woocommerce_star_rating_size_recent_reviews', 'woostore_star_reviews');

if (!function_exists('woostore_star_reviews')) {
	function woostore_star_reviews() {
		return 12;
	}
}

// Sticky shortcode
function woo_shortcode_sticky( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'class' => '',
      ), $atts ) );
 
   return '<div class="shortcode-sticky ' . esc_attr($class) . '">' . $content . '</div><!--/shortcode-sticky-->';
}

add_shortcode( 'sticky', 'woo_shortcode_sticky' );

// Sale shortcode
function woo_shortcode_sale ( $atts, $content = null ) {
	$defaults = array();
	extract( shortcode_atts( $defaults, $atts ) );
	return '<div class="shortcode-sale"><span>' . $content . '</span></div><!--/.shortcode-sale-->';
}

add_shortcode( 'sale', 'woo_shortcode_sale' );

// Add image wrap
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_open', 5, 2);

if (!function_exists('woocommerce_product_thumbnail_wrap_open')) {
	function woocommerce_product_thumbnail_wrap_open() {
		echo '<div class="img-wrap">';
	}
}

// Close image wrap
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_product_thumbnail_wrap_close', 15, 2);

if (!function_exists('woocommerce_product_thumbnail_wrap_close')) {
	function woocommerce_product_thumbnail_wrap_close() {
		echo '</div> <!--/.wrap-->';
	}
}

// Handle cart in header fragment for ajax add to cart
add_filter('add_to_cart_fragments', 'woocommerceframework_header_add_to_cart_fragment');

if (!function_exists('woocommerceframework_header_add_to_cart_fragment')) {
	function woocommerceframework_header_add_to_cart_fragment( $fragments ) {
		global $woocommerce;
		
		ob_start();
		
		?>
		<ul class="mini-cart">
			<li>
				<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>" class="cart-parent">
					<span> 
				<?php 
				echo $woocommerce->cart->get_cart_total();;
				echo sprintf(_n('<mark>%d item</mark>', '<mark>%d items</mark>', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);
				?>
				</span>
				</a>
				<?php
		
		        echo '<ul class="cart_list">';
		        echo '<li class="cart-title"><h3>'.__('Your Cart Contents', 'woothemes').'</h3></li>';
		           if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
			           $_product = $cart_item['data'];
			           if ($_product->exists() && $cart_item['quantity']>0) :
			               echo '<li class="cart_list_product"><a href="'.get_permalink($cart_item['product_id']).'">';
			               
			               echo $_product->get_image();
			               
			               echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title(), $_product).'</a>';
			               
			               if($_product instanceof woocommerce_product_variation && is_array($cart_item['variation'])) :
			                   echo woocommerce_get_formatted_variation( $cart_item['variation'] );
			                 endif;
			               
			               echo '<span class="quantity">' .$cart_item['quantity'].' &times; '.woocommerce_price($_product->get_price()).'</span></li>';
			           endif;
			       endforeach;
		
		        	else: echo '<li class="empty">'.__('No products in the cart.','woothemes').'</li>'; endif;
		        	if (sizeof($woocommerce->cart->cart_contents)>0) :
		            echo '<li class="total"><strong>';
		
		            if (get_option('js_prices_include_tax')=='yes') :
		                _e('Total', 'woothemes');
		            else :
		                _e('Subtotal', 'woothemes');
		            endif;
							
						
							
		            echo ':</strong>'.$woocommerce->cart->get_cart_total();'</li>';
		
		            echo '<li class="buttons"><a href="'.$woocommerce->cart->get_cart_url().'" class="button">'.__('View Cart &rarr;','woothemes').'</a> <a href="'.$woocommerce->cart->get_checkout_url().'" class="button checkout">'.__('Checkout &rarr;','woothemes').'</a></li>';
		        endif;
		        
		        echo '</ul>';
		
		    ?>
			</li>
		</ul>
		<?php
		
		$fragments['ul.mini-cart'] = ob_get_clean();
		
		return $fragments;
		
	}
}

?>