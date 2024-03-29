<?php

// Register widgetized areas

if (!function_exists( 'the_widgets_init')) {
	function the_widgets_init() {
	    if ( !function_exists( 'register_sidebar') )
	        return;
	
	    register_sidebar(array( 'name' => 'Primary','id' => 'primary','description' => "Normal full width Sidebar", 'before_widget' => '<section id="%1$s" class="widget %2$s">','after_widget' => '</section>','before_title' => '<h3>','after_title' => '</h3>'));   
/*
	    register_sidebar(array( 'name' => 'Secondary Left','id' => 'secondary-1', 'description' => "Left column (part of 2-col sidebar)", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	    register_sidebar(array( 'name' => 'Secondary Right','id' => 'secondary-2', 'description' => "Right column (part of 2-col sidebar)", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));	
*/
	    register_sidebar(array( 'name' => 'Footer 1','id' => 'footer-1', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	    register_sidebar(array( 'name' => 'Footer 2','id' => 'footer-2', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	    register_sidebar(array( 'name' => 'Footer 3','id' => 'footer-3', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	    register_sidebar(array( 'name' => 'Footer 4','id' => 'footer-4', 'description' => "Widetized footer", 'before_widget' => '<div id="%1$s" class="widget %2$s">','after_widget' => '</div>','before_title' => '<h3>','after_title' => '</h3>'));
	    register_sidebar(array(
		  	'name' => __( 'Homepage Header Widget' ),
			'id' => 'header-widget',
	        'before_widget' => '<section id="%1$s" class="%2$s">',
	        'after_widget' => '</section>',
	        'before_title' => '<h4>',
	        'after_title' => '</h4>',
		));
		register_sidebar(array(
		  	'name' => __( 'Homepage Content' ),
			'id' => 'homepage-content',
	        'before_widget' => '<section id="%1$s" class="%2$s">',
	        'after_widget' => '</section>',
	        'before_title' => '<h2>',
	        'after_title' => '</h2>',
		));
	}
}

add_action( 'init', 'the_widgets_init' );


    
?>