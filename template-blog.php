<?php
/*
Template Name: Blog
*/

get_header();
global $woo_options;
?>
    <!-- #content Starts -->
	<?php woo_content_before(); ?>
    <div class="row visible">
                        
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<?php woo_breadcrumbs(); ?>
		<?php } ?> 
		
		<section id="content" role="content">  

        <?php
        	if ( get_query_var( 'paged') ) { $paged = get_query_var( 'paged' ); } elseif ( get_query_var( 'page') ) { $paged = get_query_var( 'page' ); } else { $paged = 1; }
        	
        	$query_args = array(
        						'post_type' => 'post', 
        						'paged' => $paged
        					);
        	
        	$query_args = apply_filters( 'woo_blog_template_query_args', $query_args ); // Do not remove. Used to exclude categories from displaying here.
        	
        	query_posts( $query_args );
        	
        	if ( have_posts() ) {
        		$count = 0;
        		while ( have_posts() ) { the_post(); $count++;
        ?>                                                            
            
            <!-- Post Starts -->
            <article <?php post_class(); ?>>
			
				<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woo themes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
								
				<section class="article-content">
				
					 <?php if ( $woo_options['woo_post_content'] != 'content' ) woo_image( 'width=' . $woo_options['woo_thumb_w'] . '&height='.$woo_options['woo_thumb_h'] . '&class=thumbnail ' . $woo_options['woo_thumb_align'] ); ?> 
					
					<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
				
				</section><!--/.article-content-->
				
				<aside class="meta">
				
					<ul>
						<li class="date"><?php the_time('j F Y', '<time>', '</time>'); ?></li>
						<li class="author"><?php the_author_posts_link(); ?></li>
						<li class="category"><?php the_category(', '); ?></li>
						<!--<li class="tags"><?php // the_tags('Tagged: ',', ',''); ?></li>-->
						<li class="comments"><?php comments_popup_link(__( '0 Comments', 'woo themes' ), __( '1 Comment', 'woo themes' ), __( '% Comments', 'woo themes' )); ?></li>
						<?php the_tags( '<li class="tags">', ', ', '</li>' ); ?>
					</ul>
				
				</aside><!--/.meta-->
			
			</article><!--/.post-->
                                                
        <?php
        		} // End WHILE Loop
        	
        	} else {
        ?>
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ); ?></p>
            </div><!-- /.post -->
        <?php } // End IF Statement ?>  
    
            <?php woo_pagenav(); ?>
			<?php wp_reset_query(); ?>                

        </section><!-- /#content -->
            
		<?php get_sidebar(); ?>

    </div><!-- /.row -->    
		
<?php get_footer(); ?>