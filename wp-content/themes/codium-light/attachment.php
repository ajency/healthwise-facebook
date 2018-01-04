<?php get_header() ?>
<div id="containerlarge">
	<div id="content" class="sixteen columns">
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
					<li class="divider">/</li>
					<li>
						<div style="display:inline" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
							<a href="<?php echo get_permalink($post->post_parent) ?>" itemprop="url">
								<span itemprop="title">
									<div class=""><?php echo get_the_title($post->post_parent) ?></div>
								</span>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="dp100 infocontainer justif">
			<?php the_post() ?>
			<h1 class="page-title"><a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment"><?php printf(__('Attachment : ', 'codium_light')) ?><?php echo get_the_title($post->post_parent) ?></a></h1>
			<div class="hr"></div>
			<div class="entry-content">
				<div id="post-<?php the_ID(); ?>" class="<?php codium_light_post_class() ?>">
					<h3 class="entry-title"><?php the_title() ?></h3>
					<p style="text-align: center;"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></p>
					<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'codium_light'), "</div>\n", 'number'); ?>
					<span class="meta-nav-left"></span> <?php printf(__('Back to post : ', 'codium_light')) ?><a href="<?php echo get_permalink($post->post_parent) ?>" rev="attachment"><?php echo get_the_title($post->post_parent) ?></a>	
					<div class="dp100">
						<div class="dp50">
							<div class="postthumbimg-ds">
								<?php previous_image_link('thumbnail') ?>
							</div>
						</div>
						<div class="dp50">
							<div class="postthumbimg-dsr">
								<?php next_image_link('thumbnail') ?>
							</div>
						</div>
					</div>
					<div class="clear"></div>
					<div class="entry-meta">
						<?php codium_light_posted_on(); ?>
						<?php codium_light_posted_in(); ?>	
						<?php edit_post_link(__('Edit', 'codium_light'), "\n\t\t\t\t\t<span class=\"edit-link\">", "</span>"); ?>
					</div>
					<div class="hr"></div>
				</div>
				<!-- .post -->
				<?php comments_template(); ?>
			</div>
		</div>
	</div>
	<!-- #content -->
</div>
<!-- #container -->
<?php get_footer() ?>