<?php if (have_posts()) :?>
	
	<?php while (have_posts()) : the_post(); ?>
	
		<article <?php post_class(); ?>>
			
				<h1 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'woothemes' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				
				<aside class="threecol meta">
				
					<ul>
						<li class="date"><?php the_time('j F Y', '<time>', '</time>'); ?></li>
						<li class="author"><?php the_author_posts_link(); ?></li>
						<li class="category"><?php the_category(', '); ?></li>
						<!--<li class="tags"><?php // the_tags('Tagged: ',', ',''); ?></li>-->
						<li class="comments"><?php comments_popup_link(__( '0 Comments', 'woothemes' ), __( '1 Comment', 'woo themes' ), __( '% Comments', 'woothemes' )); ?></a></li>
						<li class="tags"><?php the_tags( '', ',', '' ); ?></li>
					</ul>
				
				</aside><!--/.meta-->
				
				<section class="article-content ninecol last">
					
					<?php if ( $woo_options[ 'woo_post_content' ] == "content" ) the_content(__( 'Read More...', 'woothemes' )); else the_excerpt(); ?>
					
					<div class="post-more">      
	                	<?php if ( $woo_options[ 'woo_post_content' ] == "excerpt" ) { ?>
	                    <span class="read-more"><a href="<?php the_permalink() ?>" title="<?php esc_attr_e( 'Continue Reading &rarr;', 'woothemes' ); ?>"><?php _e( 'Continue Reading &rarr;', 'woothemes' ); ?></a></span>
	                    <?php } ?>
	                </div>  
				
				</section><!--/.article-content-->
			
			</article><!--/.post-->
	
	<?php endwhile; ?>
	
<?php else : ?>

	<h2>Not found</h2>
	
<?php endif; ?>