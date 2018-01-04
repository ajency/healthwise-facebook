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
				</ul>
			</div>
		</div>
		<div class="dp100 entry-content infocontainer justif">
			<?php the_post() ?>
			<div id="post-<?php the_ID(); ?>" class="<?php codium_light_post_class() ?>">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="hr"></div>
				<?php the_content() ?>
				<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'codium_light'), "</div>\n", 'number'); ?>
				<div class="clear"></div>
				<?php edit_post_link(__('Edit', 'codium_light'),'<span class="edit-link">','</span>') ?>
			</div>
			<!-- .post -->
			<?php comments_template(); ?>
		</div>
	</div>
	<!-- #content -->
</div>
<!-- #container -->
<?php get_footer() ?>