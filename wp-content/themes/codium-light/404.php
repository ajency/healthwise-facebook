<?php get_header('404') ?>
<div id="container">
	<div id="content" class="entry-content sixteen columns">
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
		<div id="post-0" class="post error404 not-found">
			<div class="sixteen columns infocontainer justif">
				<h1 class="entry-title"><?php _e( 'Oups...', 'codium_light' ); ?></h1>
				<div class="hr"></div>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'codium_light' ); ?></p>
					<div class="search-box-404">
						<?php get_search_form(); ?>
					</div>
				</div>
				<!-- .entry-content -->
			</div>
		</div>
		<!-- #post-0 -->
	</div>
	<!-- #content -->
</div>
<!-- #container -->
<script type="text/javascript">
	// focus on search field after it has loaded
	document.getElementById('s') && document.getElementById('s').focus();
</script>
<?php get_footer() ?>