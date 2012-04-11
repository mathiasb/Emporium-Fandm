<?php
/*
Template Name: Image Gallery
*/
?>

<?php get_header(); ?>
       
    <div class="row visible">
                                                                            
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<?php woo_breadcrumbs(); ?>
		<?php } ?> 
		
		<section id="content" role="content"> 

            <div <?php post_class(); ?>>

			    <h1 class="title"><?php the_title(); ?></h1>
                
				<div class="entry">

		            <?php if (have_posts()) : the_post(); ?>
	            	<?php the_content(); ?>
		            <?php endif; ?>  

                <?php query_posts( 'showposts=60' ); ?>
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>				
                    <?php $wp_query->is_home = false; ?>

                    <?php woo_image( 'single=true&class=thumbnail alignleft' ); ?>
                
                <?php endwhile; endif; ?>	
                </div>

            </div><!-- /.post -->
            <div class="fix"></div>                
                                                            
		</section><!-- /#content -->
		
        <?php get_sidebar(); ?>

    </div><!-- /.row -->
		
<?php get_footer(); ?>