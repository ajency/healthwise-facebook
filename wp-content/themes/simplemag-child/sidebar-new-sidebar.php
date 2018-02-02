<?php /* Template Name: pledge-template */ ?>
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

	if(is_user_logged_in())
		{
		echo '<div id="login_container" class="content-area">';
		$current_user = wp_get_current_user();
		$user=$current_user->ID;
		$post_id=$_SESSION['pledge'];
		//check if user exists
		$check = $wpdb->get_results(
		"SELECT user_id,post_id FROM pledged_users
		WHERE user_id = ".$user." AND post_id = ".$post_id
		);
		if ($check!=NULL)
			{
			// user exists
				$post=get_post($post_id);
			echo "<div class='pledge_image'>";
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?> <img src="<?php echo $url ?>" />
			<?php echo "</div>";
			echo "<h5>Seems like you have already pledged to</h5>";
			echo( '<h2 class="entry-title"><u>' . $post->post_title.'</u></h2>' );
			echo( '<h6>' . $post->post_content.'</h6>' );
			echo do_shortcode('[TheChamp-Sharing]'); 
			}
		else
			{
			// user does not exist
			//insert user in database
			echo "<div class='pledge_image'>";
			$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?> <img src="<?php echo $url ?>" />
			<?php echo "</div>";
			echo "<h5>Great! you have pledged to</h5>";
			$post=get_post($post_id);
			//****
			//echo "null ".$post;
			echo( '<h2 class="entry-title"><u>' . $post->post_title.'</u></h2>' );
			echo( '<h6>' . $post->post_content.'</h6>' );
				if ($user != 0 && $post_id!=0) {
				$wpdb->insert( 'pledged_users',array(
				'user_id' => $user,
				'post_id' => $post_id)
				,array('%d','%d'));
				$wpdb->show_errors();
				}
			echo do_shortcode('[TheChamp-Sharing]'); 
			}

		?>
				<?php echo "</div>" ?>
		<?php
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
				echo( '<h2 class="entry-title">' . the_content( 'echo=0' ).'</h2>' ); 

				?>
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