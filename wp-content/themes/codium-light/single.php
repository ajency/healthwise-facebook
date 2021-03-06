<?php 
	/**
	 * The Template for displaying all single posts
	 *
	 */
	
get_header(); 
?>
<div id="containerlarge">
	<div id="content" class="sixteen columns">
		<?php the_post(); ?>
		<div id="post-<?php the_ID(); ?>" class="<?php codium_light_post_class(); ?>">
			<div class="dp100">
				<div class="item">
					<div id="top" class="dp100 breadcrumbs-one entrycontent">
						<ul id="breadcrumbs-one">
							<li>
								<div style="display:inline" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
									<a href="<?php echo esc_url(home_url( '/' )); ?>" itemprop="url">
										<div class="homebutton"><span itemprop="title"><?php printf(__('%s', 'codium_light'), 'Home') ?></span></div>
									</a>
								</div>
							</li>
							<?php 
								$categories = get_the_category();
								$output = '';
								if($categories){
								    foreach($categories as $category) {
								?>
							<li class="divider">/</li>
							<li>
								<div style="display:inline" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_category_link( $category->term_id ); ?>" itemprop="url"><span itemprop="title"><?php echo $category->cat_name; ?></span></a></div>
							</li>
							<?php        
								}
								}    
								?>
						</ul>
					</div>
				</div>
				<div class="clear"></div>
				<div class="entry-content">
					<div class="dp100 infocontainer justif">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<div class="hr"></div>
						<?php the_content(); ?>
						<div class="clear"></div>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'codium_light' ), 'after' => '</div>' ) ); ?>
						<div class="entry-meta">
							<?php codium_light_posted_on(); ?>
							<?php codium_light_posted_in(); ?>	
							<?php edit_post_link(__('Edit', 'codium_light'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>
						</div>
						<div class="clear"></div>
						<div class="hr"></div>
						<div id="nav-below" class="navigation">
							<div class="nav-previous"><?php previous_post_link('%link', '<span class="meta-nav-left"></span> %title') ?></div>
							<div class="nav-next"><?php next_post_link('%link', '%title <span class="meta-nav-right"></span>') ?></div>
						</div>
						<div class="clear"></div>
						<div class="hr"></div>
						<?php comments_template(); ?> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php get_footer() ?>