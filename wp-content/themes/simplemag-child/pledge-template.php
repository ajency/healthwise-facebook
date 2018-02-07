<?php /* Template Name: pledge-template */ ?>
<!-- <style type="text/css">
	.content-area{
	float:right;
	border:1px solid black;
	padding : 1%;
}

</style> -->
<?php 
session_start();
get_header();
 ?>
<div class="wrap" onload="hello()">
<?php 
global $page;
/*
	if(is_user_logged_in())
	{
		echo '<div id="login_container" class="content-area">';
		$current_user = wp_get_current_user();
		$user=$current_user->ID;
		$post=$_SESSION['pledge'];
		//check if user exists
		$check = $wpdb->get_results(
                    "SELECT user_id,post_id FROM wp_pledged_users
                    WHERE user_ID = ".$user." AND post_id = ".$post
            );

		if ($check!=NULL)
		{
		    // user exists
		    echo "<h5>Seems like you have already pledged to</h5>";
		    		$query_post=get_post($post);
		    		echo( '<h2 class="entry-title"><u>' . $query_post->post_title.'</u></h2>' );
		    		echo( '<h6>' . $query_post->post_content.'</h6>' );
					echo do_shortcode('[TheChamp-Sharing]'); 
		}
		else
		{
			// user does not exist
			//insert user in database
			  echo "<h5>Great! you have pledged to</h5>";
			$query_post=get_post($post);
		    		echo( '<h2 class="entry-title"><u>' . $query_post->post_title.'</u></h2>' );
		    		echo( '<h6>' . $query_post->post_content.'</h6>' );
			if ($user != 0 && $post!=0) {
		        $wpdb->insert( 'wp_pledged_users',array(
		        'user_id' => $user,
		        'post_id' => $post)
		        ,array('%d','%d'));
		        $wpdb->show_errors();
			}
			echo do_shortcode('[TheChamp-Sharing]'); 
		}
		
?>
</div>
<?php
	} 
	else
	{*/
?>

		<div id="pledge-container">
		
	</div>
	<div id="login_container" class="content-area">
			<main id="main" class="site-main" role="main">
				<?php $loop = new WP_Query( array( 	'post_type' => 'pledge',
													'posts_per_page' => 1 ,
													'paged' => get_query_var('paged') ? get_query_var('paged') : 1) ); 
				?>

				<?php
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<?php echo( '<h2 class="entry-title">' . the_title_attribute( 'echo=0' ).'</h2>' ); ?>
					<div id="login">

						<!-- function on login -->
						<?php 
						$title=the_title_attribute( 'echo=0' );
						$page=get_page_by_title( $title, '', 'pledge' );
						$x= $page->ID;
						$_SESSION["pledge"] = $x;
							/*the_content();*/ 
							//$x=$post;
						echo do_shortcode('[TheChamp-Login]'); 
							/*the_content();*/
							//echo the_champ_login_shortcode($params,null);
						?>
					</div>
				<?php endwhile; ?>
			</main><!-- #main -->
	</div><!-- #primary -->
<?php
}
?>
</div>
<?php get_footer();