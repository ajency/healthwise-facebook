<style>
.content-area{
	float:right;
	border:1px solid black;
	padding : 1%;
	width:30%;
	height: 30%;
}
</style>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
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
<?php 
	if(is_user_logged_in())
	{
?>
<div class="content-area">
	You have pledged, Thank you.<br>
	Welcome to healthy future.
</div>
<?php
	} 
	else
	{
?>

<div class="wrap">
		<div id="pledge-container">
		
	</div>
	<div id="login_container" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php $loop = new WP_Query( array( 	'post_type' => 'pledge',
													'posts_per_page' => 1 ,
													'paged' => get_query_var('paged') ? get_query_var('paged') : 1) ); 
				?>

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<?php echo( '<h2 class="entry-title"><a href="'.get_permalink().'">' . the_title_attribute( 'echo=0' ) . '</a></h2>' ); ?>
				<div id="login">
				<?php 
					/*the_content();*/ 
					echo do_shortcode('[TheChamp-Login]') 
				?>
				</div>
					<?php endwhile; ?>
			</main><!-- #main -->
	</div><!-- #primary -->
<?php
}
?>
</div><!-- .wrap -->
<?php get_footer();
