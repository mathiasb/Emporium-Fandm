<?php get_header(); ?>
       
    <div class="row visible">
            
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?> 
		
		<section id="content" role="content"> 
			
			<?php if (have_posts()) : $count = 0; ?>
            
            <span class="archive_header"><?php _e( 'Search results:', 'woothemes' ) ?> <?php the_search_query();?></span>
                
            <?php while (have_posts()) : the_post(); $count++; ?>
                                                                        
            <!-- Post Starts -->
            <div <?php post_class(); ?>>
            
                <h2 class="title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                
                <?php woo_post_meta(); ?>
                
                <div class="entry">
                    <?php the_excerpt(); ?>
                </div><!-- /.entry -->
                        
            </div><!-- /.post -->
                                                    
            <?php endwhile; else: ?>
            
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
            
            <?php endif; ?>  
        		
        	<?php wp_reset_query(); ?>
        		
			<?php woo_pagenav(); ?>
                
        </section><!-- /#content -->

        <?php get_sidebar(); ?>

    </div><!-- /.row -->
		
<?php get_footer(); ?>
