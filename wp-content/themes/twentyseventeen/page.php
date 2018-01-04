<style>
.pagination {
    display: inline-block;
	margin :auto;
	margin-top:20%;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}

</style>

<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		
		
		    <?php $loop = new WP_Query( array( 	'post_type' => 'pledge',
												'posts_per_page' => 1 ,
												'paged' => get_query_var('paged') ? get_query_var('paged') : 1) ); 
			?>

<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

    <?php the_title( '<h2 class="entry-title"><a href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" rel="bookmark">' ,'</a>     </h2>' ); ?>

    <div class="entry-content">
	<?php $x = '';
			$xurl='';
		?>
        <?php /*the_content();*/echo the_champ_login_shortcode($params,$x); ?>
		
		<?php
//echo	changeurl($xurl);
		?>
		
		
		
		
		
		
		
    </div>


<div >
<?php  // echo do_shortcode('[TheChamp-Login]');?>
</div>

	<?php endwhile; ?>
	
		</main>
	</div>



<div class="pagination">
<?php /*
		$big = 999999999; // need an unlikely integer
 echo paginate_links( array(
    'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
    'format' => '?paged=%#%',
    'current' => max( 1, get_query_var('paged') ),
    'total' => $loop->max_num_pages
) );*/
		?>
		 
	</div>		

</div>
<?php get_footer();
