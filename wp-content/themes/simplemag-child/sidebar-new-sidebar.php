<?php /* Template Name: pledge-template */ ?>
<script type="text/javascript">
	function hello_count($count){
		alert($count);
	}
</script>
<style type="text/css">
	.content-area{
		
	/*float:right;*/
	border:1px solid black;
	padding : 1%;
	}
	.pledge_image
	{
		max-width: 100px;
	}
</style>
<div class="wrap">

	<?php 
	global $page;
	wp_reset_postdata();
	if(is_user_logged_in() || !is_front_page())
	{


		echo "<img src='wp-content/themes/simplemag-child/image.png' width='55px'>";
		$post_id=get_the_ID();
		echo '<span>';

		echo "<span id='links'>";
		$count= $wpdb->get_var(
		"SELECT count(post_id) FROM pledged_users
		WHERE post_id = ".$post_id
		);
		echo $count;
		echo "</span>";
		echo "<br>Have already taken pledge";
		echo "</span>";
		if(!is_user_logged_in())
            {
               echo do_shortcode('[TheChamp-Login]');
            }
            else
            {
		// adding data
			$current_user = wp_get_current_user();
			$user=$current_user->ID;
			//check if user exists
			$check = $wpdb->get_results(
			"SELECT user_id,post_id FROM pledged_users
			WHERE user_id = ".$user." AND post_id = ".$post_id
			);
			if ($check==NULL)
				{
				// user does not exist
				//insert user in database
					if ($user != 0 && $post_id!=0) {
						$wpdb->insert( 'pledged_users',array(
						'user_id' => $user,
						'post_id' => $post_id)
						,array('%d','%d'));
						$wpdb->show_errors();
						echo $count;
						hello_count($count);
					}
				}
		//ending data
			}


	} 
	else
	{

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
			while ( $loop->have_posts() ) : $loop->the_post(); 
				echo "<div class='pledge_image'>";
				the_post_thumbnail('thumbnail');
				echo "</div>";
				echo( '<h2 class="entry-title">' . the_title_attribute( 'echo=0' ).'</h2>' ); 
				//echo( '<h2 class="entry-title">' . the_content( 'echo=0' ).'</h2>' ); 
				$excerpt=get_the_excerpt();
				echo $excerpt;
				?>
				<a href=<?php the_permalink(); ?>>Read more</a>
				<div id="login">

					<!-- function on login -->
					<?php 
					$title=the_title_attribute( 'echo=0' );
					//*****
					$page=get_page_by_title( $title, '', 'pledge' );
					$x= $page->ID;
					$_SESSION["pledge"] = $x;
					$current_post= get_the_ID();

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