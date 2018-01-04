
<?php
/**
 * Template Name: Movie Reviews
 **/

 get_header(); ?>

 
 
 <?php while ( have_posts() ) : the_post(); ?>





<?php
 $query = new WP_Query( array('post_type' => 'movie-reviews', 'posts_per_page' => 5 ) );
 while ( $query->have_posts() ) : $query->the_post(); ?>

<?php endif; wp_reset_postdata(); ?>
<?php endwhile; ?>

 
 



<div class="clear">
</div>

<div id="main-content-wrapper">

	<div id="main-content">

	<?php if ( have_posts() ) :
			
			while ( have_posts() ) :
			
				the_post();

				// includes the single page content templata here
				get_template_part( 'content', 'page' );

				// if comments are open or there's at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			
			endwhile;
			
			wp_link_pages( array(
							'link_before'      => '<li>',
							'link_after'       => '</li>',
						 ) );
				
		  else : 
		  
			// if no content is loaded, show the 'no found' template
			get_template_part( 'content', 'none' );
	 
		  endif; ?>

	</div><!-- #main-content -->

	<?php get_sidebar(); ?>

</div><!-- #main-content-wrapper -->

<?php get_footer(); ?>