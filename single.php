<?php get_header(); ?>
<?php global $woo_options; ?>
       
    <div class="row visible">
		           
		<?php if ( $woo_options[ 'woo_breadcrumbs_show' ] == 'true' ) { ?>
			<div id="breadcrumbs">
				<?php woo_breadcrumbs(); ?>
			</div><!--/#breadcrumbs -->
		<?php } ?>  
		
		<?php get_sidebar(); ?>
		
		<section id="content" role="content">

        <?php if (have_posts()) : $count = 0; ?>
        <?php while (have_posts()) : the_post(); $count++; ?>
        
			<article <?php post_class(); ?>>

				<?php echo woo_embed( 'width=580' ); ?>
                <?php if ( $woo_options[ 'woo_thumb_single' ] == "true" && !woo_embed( '')) woo_image( 'width='.$woo_options[ 'woo_single_w' ].'&height='.$woo_options[ 'woo_single_h' ].'&class=thumbnail '.$woo_options[ 'woo_thumb_single_align' ]); ?>
				
				<header>
				
                	<h1 class="title"><?php the_title(); ?></h1>
                
                </header>
                                                
                <div class="entry">
                	<?php the_content(); ?>
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

				<?php if ( $woo_options[ 'woo_post_author' ] == "true" ) { ?>
				<div id="post-author" class="row visible">
					<div class="profile-image"><?php echo get_avatar( get_the_author_meta( 'ID' ), '70' ); ?></div>
					<div class="profile-content">
						<h3 class="title"><?php printf( esc_attr__( 'About %s', 'woothemes' ), get_the_author() ); ?></h3>
						<?php the_author_meta( 'description' ); ?>
						<div class="profile-link">
							<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'woothemes' ), get_the_author() ); ?>
							</a>
						</div><!-- #profile-link	-->
					</div><!-- .post-entries -->
					<div class="clear"></div>
				</div><!-- #post-author -->
				<?php } ?>

				<?php woo_subscribe_connect(); ?>

	        <div id="post-entries">
	            <div class="nav-prev fl"><?php previous_post_link( '%link', '<span class="meta-nav">&larr;</span> %title' ) ?></div>
	            <div class="nav-next fr"><?php next_post_link( '%link', '%title <span class="meta-nav">&rarr;</span>' ) ?></div>
	            <div class="fix"></div>
	        </div><!-- #post-entries -->
            
            <?php $comm = $woo_options[ 'woo_comments' ]; if ( ($comm == "post" || $comm == "both") ) : ?>
                <?php comments_template( '', true); ?>
            <?php endif; ?>
                                                
		<?php endwhile; else: ?>
			<div <?php post_class(); ?>>
            	<p><?php _e( 'Sorry, no posts matched your criteria.', 'woothemes' ) ?></p>
			</div><!-- .post -->             
       	<?php endif; ?>  
        
		</section><!-- #content -->

        

    </div><!-- /.row -->
		
<?php get_footer(); ?>