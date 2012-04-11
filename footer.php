<?php global $woo_options; ?>

			<div class="clear"></div>
	
		</div><!--/.wrapper-->
	
	</div><!--/.content-wrapper-->

<!-- Here's the actual footer -->


	<footer id="footer" class="row">
	
		<div class="wrapper visible">
			
			<!-- Insert the footer widget columns -->
			
			<?php
			$total = $woo_options[ 'woo_footer_sidebars' ]; if (!isset($total)) $total = 4;
			if ( ( woo_active_sidebar( 'footer-1') ||
				   woo_active_sidebar( 'footer-2') ||
				   woo_active_sidebar( 'footer-3') ||
				   woo_active_sidebar( 'footer-4') ) && $total > 0 ) :
			
			?>
			
			<section id="footer-widgets" class="col-<?php echo $total; ?>">
			
				<?php $i = 0; while ( $i < $total ) : $i++; ?>
				<?php if ( woo_active_sidebar( 'footer-'.$i) ) { ?>
	
				<div class="block footer-widget-<?php echo $i; ?>">
		        	<?php woo_sidebar( 'footer-'.$i); ?>
				</div>
		
			        <?php } ?>
				<?php endwhile; ?>
				<?php endif; ?>
			
			</section>
			
			<!-- End the footer widget columns -->
			
			<section class="basement col2-set">
			
				
			
				
				<?php if( $woo_options[ 'woo_footer_left' ] == 'true' ) {
						echo '<div class="col-1">';
						echo stripslashes( $woo_options['woo_footer_left_text'] );
						echo '</div>';
		
				} else { ?>
					
					<p class="copyright sixcol"><?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', 'woothemes' ); ?></p>
					
				<?php } ?>
				
			
				<?php if( $woo_options[ 'woo_footer_right' ] == 'true' ){
					echo '<div class="col-2">';
		        	echo stripslashes( $woo_options['woo_footer_right_text'] );
		        	echo '</div>';
				} else { ?>
					
					<p class="promotion sixcol last"><?php _e( 'Powered by', 'woothemes' ); ?> <a href="http://www.wordpress.org">WordPress</a>. <?php _e( 'Designed by', 'woothemes' ); ?> <a href="<?php echo ( !empty( $woo_options['woo_footer_aff_link'] ) ? esc_url( $woo_options['woo_footer_aff_link'] ) : 'http://www.woothemes.com' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logos/woothemes.png" width="74" height="19" alt="Woo Themes" /></a></p>
					
				<?php } ?>
				
				
				
			
			</section><!--/.basement-->
		
		</div><!--/.wrapper-->
	
	</footer><!--/#footer-->


<?php wp_footer(); ?>
<?php woo_foot(); ?>

</body>
</html>