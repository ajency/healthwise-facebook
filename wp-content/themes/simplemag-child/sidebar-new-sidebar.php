<?php /* Template Name: pledge-template */ ?>
<!-- <style type="text/css">
	.content-area{
		
	/*float:right;*/
	border:1px solid black;
	padding : 1%;
	}
	.pledge_image
	{
		max-width: 100px;
	}
</style> -->
<div class="wrap">

	<?php 
	global $page;
	wp_reset_postdata();
	if(is_user_logged_in() || !is_front_page())
	{
		$post_id=get_the_ID();
		$count= $wpdb->get_var(
		"SELECT count(post_id) FROM pledged_users
		WHERE post_id = ".$post_id
		);

		echo "<div class='grids x'>";
			echo "<div class='grid-2 column-1'>";
				echo "<span class='users_image'> ";
	
				echo "</span>";
			echo "</div>";
			echo "<div class='grid-8 column-2 count_b'>";
				echo "<span id='links' class='count_block'>";
					echo $count;

				echo "</span><br/>";
				echo "<span class='pledge_done'>Have already taken pledge</span>";

			echo "</div>";
		echo "</div>";
		
		
		// echo '<span>';

		// echo "<span id='links'>";
		
		// echo "<span class='count_block'>";
			// echo $count;
		// echo "</span>";

		// echo "</span><br/>";
		// echo "<span class='have_pledged'>You have already taken pledge</span>";
		// echo "</span>";

		if(!is_user_logged_in() || km_get_user_role(wp_get_current_user()->ID)=="administrator")
           {
              echo"<div class='login_b'>";
              echo do_shortcode('[TheChamp-Login]');
              echo"</div>";
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
						//echo $count;
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
				echo "<div class='pledge_image_outer'>";
				echo "<div class='pledge_image'>";

				the_post_thumbnail('abc');
				echo "</div>";
				echo "</div>";
				$data=get_the_category($post->ID);
				if (empty($data[0])) {
					echo("<span class='text-grey'>Uncategorized</span>");
				}
				else
				{
					for ($i=0;!empty($data[$i]);$i++) {
						if($i>0)
							echo "<span class='text-grey'>,</span>";
					echo("<span class='text-grey'>".$data[$i]->name."</span>");
					}
				}
				echo"<span class='text-grey'>";
				echo "/".get_the_date();
				echo "</span>";
				echo( '<h2 class="entry-title ptop1 text-black">' . the_title_attribute( 'echo=0' ).'</h2>' ); 
				echo( '<span class="written-by ">by </span><span class="entry-author">' . get_the_author().'</span><br/><br/>' );  
				$excerpt=get_the_excerpt();
				echo $excerpt;
				?>

				<a href=<?php the_permalink(); ?>><br/>Read more</a>

				<div id="login" class="loginpledge">


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