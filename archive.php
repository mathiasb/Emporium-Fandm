<?php get_header(); ?>
<?php global $woo_options; ?>

<div class="row visible">
                    
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  
		
		<section id="content" class="eightcol" role="content">
		
		<?php if (have_posts()) : $count = 0; ?>
		
		<?php if (is_category()) { ?>
			<h1><?php _e( 'Archive', 'woothemes' ); ?> | <?php echo single_cat_title(); ?></h1>
			<div class="category-description">
				<?php echo category_description(); ?>
			</div>      
			
			<?php } elseif (is_day()) { ?>
			<h1><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( get_option( 'date_format' ) ); ?></h1>
			
			<?php } elseif (is_month()) { ?>
			<h1><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'F, Y' ); ?></h1>
			
			<?php } elseif (is_year()) { ?>
			<h1><?php _e( 'Archive', 'woothemes' ); ?> | <?php the_time( 'Y' ); ?></h1>
			
			<?php } elseif (is_author()) { ?>
			<h1><?php _e( 'Archive by Author', 'woothemes' ); ?></h1>
			
			<?php } elseif (is_tax()) { ?>
			<h1><?php echo single_term_title( '', true); ?></h1>
			
			<div class="term-description">
				<?php echo term_description(); ?>
			</div> 
			
			<?php } elseif (is_tag()) { ?>
			<h1><?php _e( 'Tag Archives:', 'woothemes' ); ?> <?php echo single_tag_title( '', true); ?></h1>
			
			<div class="tag-description">
				<?php echo tag_description(); ?>
			</div>
            
        <?php } ?>

		<?php while (have_posts()) : the_post(); $count++; ?>
                                                                    
            <article <?php post_class(); ?>>

				<?php echo woo_embed( 'width=580' ); ?>
                <?php if ( $woo_options[ 'woo_thumb_single' ] == "true" && !woo_embed( '')) woo_image( 'width='.$woo_options[ 'woo_single_w' ].'&height='.$woo_options[ 'woo_single_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_single_align' ]); ?>
				
				<header>
				
                	<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woo themes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                
                </header>
                                                
                <div class="entry">
                	<?php if ( isset( $woo_options['woo_post_content'] ) && $woo_options['woo_post_content'] == 'content' ) { the_content( __( 'Read More...', 'woothemes' ) ); } else { the_excerpt(); } ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'woothemes' ), 'after' => '</div>' ) ); ?>
				</div>
				
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
									
                                
            </article><!-- .post -->
                                                
        <?php endwhile; else: ?>
        
            <div <?php post_class(); ?>>
                <p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
            </div><!-- /.post -->
        
        <?php endif; ?>  
    
			<?php woo_pagenav(); ?>
                
		</section><!-- /#content -->

        <?php get_sidebar(); ?>

</div><!-- /.row -->
		
<?php get_footer(); ?>