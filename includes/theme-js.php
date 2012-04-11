<?php
if ( ! is_admin() ) { add_action( 'wp_print_scripts', 'woothemes_add_javascript' ); }

if ( ! function_exists( 'woothemes_add_javascript' ) ) {
	function woothemes_add_javascript() {
	global $woo_options;

		// Use Google jQuery minified script instead
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery',  'https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js');
		wp_register_script( 'flexslider', get_template_directory_uri() . '/includes/js/jquery.flexslider-min.js', array( 'jquery' ) );
		wp_enqueue_script( 'jquery' ); 
		wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/includes/js/libs/modernizr-2.0.6.min.js' ); 
		   
		wp_enqueue_script( 'plugins', get_template_directory_uri() . '/includes/js/plugins.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'script', get_template_directory_uri() . '/includes/js/script.js', array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'googleplus', 'https://apis.google.com/js/plusone.js', array(), '1.0', true );
		
		// Only load the slider on the homepage
	
		do_action( 'woothemes_add_javascript' );
		
		if ( is_home() ){
			
			if ( isset( $woo_options['woo_slider'] ) && ( $woo_options['woo_slider'] == 'true' ) ) {
				wp_enqueue_script( 'flexslider' );
			}
			
			// Load the custom slider settings.
			
			$autoStart = false;
			$autoSpeed = 6;
			$slideSpeed = 0.5;
			$effect = 'slide';
			$nextprev = 'true';
			$pagination = 'true';
			$hoverpause = 'true';
			$autoheight = 'false';
			
			// Get our values from the database and, if they're there, override the above defaults.
			$fields = array(
							'autoStart' => 'auto', 
							'autoSpeed' => 'interval', 
							'slideSpeed' => 'speed', 
							'effect' => 'effect', 
							'nextprev' => 'nextprev', 
							'pagination' => 'pagination', 
							'hoverpause' => 'hover', 
							'autoHeight' => 'autoheight'
							);
			
			foreach ( $fields as $k => $v ) {
				if ( is_array( $woo_options ) && isset( $woo_options['woo_slider_' . $v] ) && $woo_options['woo_slider_' . $v] != '' ) {
					${$k} = $woo_options['woo_slider_' . $v];
				}
			}
			
			// Set auto speed to 0 if we want to disable automatic sliding.
			if ( $autoStart == 'false' ) {
				$autoSpeed = 0;
			}
			
			$data = array(
						'speed' => $slideSpeed, 
						'auto' => $autoSpeed, 
						'effect' => $effect, 
						'nextprev' => $nextprev, 
						'pagination' => $pagination, 
						'hoverpause' => $hoverpause, 
						'autoheight' => true
						);
						
			wp_localize_script( 'general', 'woo_slider_settings', $data );
		}
		
	}
}

?>