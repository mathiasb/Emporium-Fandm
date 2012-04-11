<?php
/*
Template Name: Full Width
*/
?>

<?php get_header(); ?>
       
    <div class="row visible">
            
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<?php woo_breadcrumbs(); ?>
		<?php } ?> 
		
		<section id="content" role="content">

            <?php if (have_posts()) : $count = 0; ?>
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
                <div <?php post_class(); ?>>

				    <h1 class="title"><?php the_title(); ?></h1>
                    
                    <div class="entry">
	                	<?php the_content(); ?>
	               	</div><!-- /.entry -->

					<?php edit_post_link( __( '{ Edit }', 'woothemes' ), '<span class="small">', '</span>' ); ?>

                </div><!-- /.post -->
                                                    
			<?php endwhile; else: ?>
				<div <?php post_class(); ?>>
                	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
                </div><!-- /.post -->
            <?php endif; ?>  
        
		</section><!-- /#content -->
		
    </div><!-- /.row -->
		
<?php get_footer(); ?>