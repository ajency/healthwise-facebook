<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<?php wp_head() ?>
</head>
<body <?php body_class(); ?> >
	<div id="wrapperpub" >
		<div id="header" class="container">
			<div id="mainlogo" class="dp70">
				<div id="blog-title" class="blogtitle"><a href="<?php echo esc_url(home_url( '/' )); ?>" title="<?php bloginfo('name') ?>"><?php bloginfo('name') ?></a></div>
				<div class="description"><?php bloginfo('description'); ?> </div>
			</div>
			<div class="search-toggle">
				<a href="#search-container" class="screen-reader-text"><?php _e( 'Search', 'codium_light' ); ?></a>
			</div>
			<div class="clear"></div>
			<div id="search-container" class="search-box-wrapper hide">
				<div class="search-box">
					<?php get_search_form(); ?>
				</div>
			</div>
			<nav id="primary-navigation" class="site-navigation primary-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Primary Menu', 'codium_light' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav>
		</div>
		<!--  #header -->	
	</div>
	<!--  #wrapperpub -->	
	<div id="wrapper" class="container">
	<div class="clear"></div>