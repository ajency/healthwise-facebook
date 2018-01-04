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
		<?php the_post() ?>
		<div class="dp100 infocontainer justif">
			<h1 class="page-title author"><?php printf(__('Author Archives: <span class="vcard">%s</span>', 'codium_light'), "<a class='url fn n' href='$authordata->user_url' title='$authordata->display_name' rel='me'>$authordata->display_name</a>") ?></h1>
			<div class="hr"></div>
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
			<div id="entry-author-info">
				<div id="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'codium_light', 60 ) ); ?>
				</div>
				<!-- #author-avatar -->
				<div id="author-description" class="entry-content">
					<h3><?php printf( __( '%s', 'codium_light' ), get_the_author() ); ?></h3>
					<div class="clear"></div>
					<p><?php the_author_meta( 'description' ); ?></p>
				</div>
				<!-- #author-description	-->
			</div>
			<!-- #entry-author-info -->
			<div class="clear"></div>
			<?php endif; ?>
		</div>
		<?php rewind_posts(); while (have_posts()) : the_post(); ?>
		<!-- Begin post -->
		<div id="post-<?php the_ID() ?>" class="<?php codium_light_post_class() ?> dp100 infocontainer justif">
			<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf(__('Link to %s', 'codium_light'), esc_html(get_the_title(), 1)) ?>" rel="bookmark"><?php the_title() ?></a></h2>
			<div class="entry-date"><abbr class="published" title="<?php the_time('Y-m-d\TH:i:sO'); ?>"><?php unset($previousday); printf(__('%1$s &#8211; %2$s', 'codium_light'), the_date('', '', '', false), get_the_time()) ?></abbr></div>
			<div class="hr"></div>
			<?php if ( has_post_thumbnail() ) {
				?> 
			<div class="entry-content">
				<p class="dropcap home"><?php echo cleanCut(get_the_excerpt(), 250); ?></p>
				<a href="<?php the_permalink() ?>" ><?php printf(__('read more <span class="meta-nav"></span>', 'codium_light')) ?></a>
				<div class="center thumbnail">
					<a href="<?php the_permalink(); ?>">
					<?php 
						$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(),'post-thumbnail' );
						                              $title = get_the_title();
						                              if($image_src[0] != '') {
										  echo '<img src="' . $image_src[0]  . '" width="" alt="'.$title.'" />';
						                              }
						                          ?>
					</a>
				</div>
				<!-- End Thumb Container -->    
				<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'codium_light'), "</div>\n", 'number'); ?>
			</div>
			<div class="clear"></div>
			<div class="entry-content">
				<div class="entry-meta">
					<?php the_tags(__('<span class="tag-links">Tags ', 'codium_light'), ", ", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n") ?>
					<?php edit_post_link(__('Edit', 'codium_light'), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n"); ?>
					<span class="comments-link"><?php comments_popup_link(__('Comment (0)', 'codium_light'), __('Comment (1)', 'codium_light'), __('Comments (%)', 'codium_light')) ?></span>
				</div>
			</div>
			<?php }
				else { ?>
			<div class="entry-content">
				<?php the_content(''.__('read more <span class="meta-nav"></span>', 'codium_light').''); ?>
				<?php wp_link_pages("\t\t\t\t\t<div class='page-link'>".__('Pages: ', 'codium_light'), "</div>\n", 'number'); ?>
			</div>
			<div class="clear"></div>
			<div class="entry-content">
				<div class="entry-meta">
					<?php the_tags(__('<span class="tag-links">Tags ', 'codium_light'), ", ", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n") ?>
					<?php edit_post_link(__('Edit', 'codium_light'), "\t\t\t\t\t<span class=\"edit-link\">", "</span>\n\t\t\t\t\t<span class=\"meta-sep\">|</span>\n"); ?>
					<span class="comments-link"><?php comments_popup_link(__('Comment (0)', 'codium_light'), __('Comment (1)', 'codium_light'), __('Comments (%)', 'codium_light')) ?></span>
				</div>
			</div>
			<?php } ?>
		</div>
		<!-- End post -->
		<div class="clear"></div>
		<?php endwhile; ?>
		<div class="center">
			<?php if(function_exists('wp_pagenavi')) { 
				wp_pagenavi();
				} else {?>
			<div class="entry-content navigation mobileoff">
				<p><?php posts_nav_link(); ?></p>
			</div>
			<?php } ?>
		</div>
	</div>
	<!-- #content -->
</div>
<!-- #container -->
<?php get_footer() ?>