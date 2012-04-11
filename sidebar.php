<?php 
	// Don't display sidebar if full width
	global $woo_options;
	if ( $woo_options[ 'woo_layout' ] != "layout-full" ) :
?>	
<aside id="sidebar" role="complementary">

	<?php if ( woo_active_sidebar( 'primary' ) ) : ?>
    <div class="primary">
		<?php woo_sidebar( 'primary' ); ?>		           
	</div>        
	<?php endif; ?>    
	
</aside><!-- /#sidebar -->

<?php endif; ?>