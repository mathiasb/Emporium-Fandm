<?php
/**
 * Header Template
 *
 * Here we setup all logic and XHTML that is required for the header section of all screens.
 *
 */
 global $woo_options;
 global $woocommerce;
?>

<?php 
	// First of all make sure WooCommerce in installed, otherwise kill the site
	if (!class_exists('woocommerce')) wp_die('WooCommerce must be installed'); 
	
	$http_or_https = (is_ssl()) ? 'https:' : 'http:';	
?>

<!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />

<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php woo_title(); ?></title>

<?php woo_meta(); ?>

<!--  Mobile viewport scale | Disable user zooming as the layout is optimised -->
<meta content="initial-scale=1.0; maximum-scale=1.0; user-scalable=no" name="viewport"/>

<!-- Display an Apple Touch icon (if present) and load securely if SSL is enabled -->

<?php if ( file_exists(TEMPLATEPATH .'/apple-touch-icon.png') ) : ?>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
<?php endif; ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!-- CSS  -->

<!-- First load the standard stylesheet. Contains all generic markup styles and mobile layout optimisation -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

<!-- /CSS -->

<?php wp_head(); ?>
<?php woo_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php woo_top(); ?>

<!-- Here's the actual header markup -->
  
	<header id="header" class="row visible" role="banner">
		
		<section class="top">
		
			<div class="col2-set">
			
				<div class="col-1 description">
					<h1><a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
					<p><?php bloginfo( 'description' ); ?></p>
				</div>
		
				<!-- Customer navigation -->
				
				<nav role="navigation" class="customer-navigation col-2">				
					<?php if ( function_exists( 'has_nav_menu') && has_nav_menu( 'top-menu' ) ) { ?>
	
							<?php wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'top-nav', 'menu_class' => 'nav', 'theme_location' => 'top-menu' ) ); ?>
				
				    <?php } ?>
				</nav>
			
			</div><!--/.col2-set-->
			
			<div class="clear"></div>
		
		</section><!--/.top-->
		
		<section class="main-nav">
		
			<!-- Main navigation -->
		  	
		  	<nav role="navigation" class="main-navigation">
		  		
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
				if ( function_exists( 'has_nav_menu') && has_nav_menu( 'primary-menu') ) {
					wp_nav_menu( array( 'depth' => 6, 'sort_column' => 'menu_order', 'container' => 'ul', 'menu_id' => 'main-nav', 'menu_class' => 'nav', 'theme_location' => 'primary-menu' ) );
				} else {
				?>
		        <ul id="main-nav">
					<?php
		        	if ( isset($woo_options[ 'woo_custom_nav_menu' ]) AND $woo_options[ 'woo_custom_nav_menu' ] == 'true' ) {
		        		if ( function_exists( 'woo_custom_navigation_output') )
							woo_custom_navigation_output();
					} else { ?>
			            <?php if ( is_page() ) $highlight = "page_item"; else $highlight = "page_item current_page_item"; ?>
			            <li class="<?php echo $highlight; ?>"><a href="<?php echo home_url( '/' ); ?>"><?php _e( 'Home', 'woothemes' ) ?></a></li>
			            <?php
			    			wp_list_pages( 'sort_column=menu_order&depth=6&title_li=&exclude=' );
					}
					?>
		        </ul><!-- /#main-nav -->
		        <?php } ?>
				  		
		  		
		  		<div class="clear"><!-- We need this for the drop downs --></div>
		  	
		  	</nav><!--/.navigation-->
		
		</section>
	
		<div class="wrapper">
		
			<h1 class="logo eightcol">
					
				<?php if ($woo_options['woo_texttitle'] != 'true' ) : $logo = $woo_options['woo_logo']; ?>
				
					<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>">
						<img src="<?php if ($logo) echo $logo; else { echo get_template_directory_uri(); ?>/images/logos/emporium.png<?php } ?>" alt="<?php bloginfo( 'name' ); ?>" />
					</a>
					
		        <?php else : ?>
				
					<a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'description' ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
					
				<?php endif; ?>
			
			</h1><!--/.logo-->
			
			<form role="search" method="get" id="searchform" class="searchform fourcol last" action="<?php echo home_url(); ?>">
				<label class="screen-reader-text" for="s"><?php _e('Search for:', 'woothemes'); ?></label>
				<input type="text" value="<?php the_search_query(); ?>" name="s" id="s"  class="field s" placeholder="<?php _e('Search for products', 'woothemes'); ?>" />
				<input type="submit" class="submit button last" name="submit" value="<?php _e('Search', 'woothemes'); ?>">
				<input type="hidden" name="post_type" value="product" />
			</form><!--/.searchform-->
		  			
		</div><!--/.wrapper-->
	  	
		<div class="clear"></div>
		
	</header>
	
<!-- Now we start the content wrapper -->
	  
	<div class="content-wrapper">
	  
		<div class="wrapper main-content row visible">