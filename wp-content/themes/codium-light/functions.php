<?php
	/*
	This file is part of codium_light. Hack and customize by henri labarre and based on the marvelous sandbox theme	codium_light is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or (at your option) any later version.
	
	*/
	
	if ( ! function_exists( 'codium_light_setup' ) ) :
	function codium_light_setup() {
	    
	    // Make theme available for translation
	    // Translations can be filed in the /languages/ directory
	    load_theme_textdomain( 'codium_light', get_template_directory() . '/languages' );
	
	    // add_editor_style support
	    add_editor_style( 'editor-style.css' );
	   
	    //feed
		add_theme_support('automatic-feed-links');
		
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
	    
		register_nav_menus( array(
			'primary'   => __( 'Top primary menu', 'codium_light' ),
		) );
	
	    // Post thumbnails support for post
		add_theme_support( 'post-thumbnails', array( 'post' ) ); // Add it for posts
		set_post_thumbnail_size( 600, 420, true ); // Normal post thumbnails
	
	    // This theme allows users to set a custom background
		add_theme_support( 'custom-background' );
	    
	    // This theme allows users to set a custom header image
	    //custom header for 3.4 and compatability for prior version
	
		$args = array(
			'width'               => 1280,
			'height'              => 250,
			'default-image'       => '',
			'default-text-color'  => '444',
			'wp-head-callback'    => 'codium_light_header_style',
			'admin-head-callback' => 'codium_light_admin_header_style',
	        
		);
	
		$args = apply_filters( 'codium_light_custom_header', $args );
	
	    add_theme_support( 'custom-header', $args );
	
	
	}
	endif; // codium_light_setup
	add_action( 'after_setup_theme', 'codium_light_setup' );

    add_theme_support( 'title-tag' ); 

    if ( ! function_exists( '_wp_render_title_tag' ) ) {
        function theme_slug_render_title() {
    ?>
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
        }
        add_action( 'wp_head', 'theme_slug_render_title' );
    }

	if ( ! function_exists( 'codium_light_scripts_styles' ) ) :
	function codium_light_scripts_styles() {
	
	    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		// Loads our main stylesheet.
		wp_enqueue_style( 'codium_light-style', get_stylesheet_uri(), array(), '2014-06-30' );
	    wp_enqueue_script( 'codium_light-script', get_template_directory_uri() . '/js/menu.js', array( 'jquery' ), '20140630', true );
	
	}
	endif; // codium_light_scripts_styles
	add_action( 'wp_enqueue_scripts', 'codium_light_scripts_styles' );
	
	
	if ( ! function_exists( 'codium_light_header_style' ) ) :
	// gets included in the site header
	function codium_light_header_style() {
	    if (get_header_image() != ''){
	    ?>
<style type="text/css">
	div#wrapperpub {
	background: url(<?php header_image(); ?>); height :230px;
	}
</style>
<?php }
	if ( 'blank' == get_header_textcolor() ) { ?>
<style type="text/css">
	h1.blogtitle,.description,.blogtitle { display: none; }
</style>
<?php } else { ?>
<style type="text/css">
	h1.blogtitle a,.blogtitle a,.description,.menu-toggle:before, .search-toggle:before,.site-navigation a { color:#<?php header_textcolor() ?>; }
	.site-navigation a:hover { background:#<?php header_textcolor() ?>; }    
</style>
<?php }
	}
	endif; // codium_light_header_style
	
	if ( ! function_exists( 'codium_light_admin_header_style' ) ) :
	// gets included in the admin header
	function codium_light_admin_header_style() {
	   ?>
<style type="text/css">
	#headimg {
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	}
</style>
<?php
	}
	endif; // codium_light_admin_header_style
	
	
	// Set the content width based on the theme's design and stylesheet.
		if ( ! isset( $content_width ) )
		$content_width = 620;
			
	if ( ! function_exists( 'codium_light_body_class' ) ) :
	// Generates semantic classes for BODY element
	function codium_light_body_class( $print = true ) {
		global $wp_query, $current_user;
	
		// It's surely a WordPress blog, right?
		$c = array('wordpress');
	
		// Applies the time- and date-based classes (below) to BODY element
		codium_light_date_classes( time(), $c );
	
		// Generic semantic classes for what type of content is displayed
		is_front_page()  ? $c[] = 'home'       : null; // For the front page, if set
		is_home()        ? $c[] = 'blog'       : null; // For the blog posts page, if set
		is_archive()     ? $c[] = 'archive'    : null;
		is_date()        ? $c[] = 'date'       : null;
		is_search()      ? $c[] = 'search'     : null;
		is_paged()       ? $c[] = 'paged'      : null;
		is_attachment()  ? $c[] = 'attachment' : null;
		is_404()         ? $c[] = 'four04'     : null; // CSS does not allow a digit as first character
		is_tax() 		 ? $c[] = 'taxonomy'   : null;
		is_sticky() 	 ? $c[] = 'sticky'     : null;
	
		// Special classes for BODY element when a single post
		if ( is_single() ) {
			$postID = $wp_query->post->ID;
			the_post();
	
			// Adds 'single' class and class with the post ID
			$c[] = 'single postid-' . $postID;
	
			// Adds classes for the month, day, and hour when the post was published
			if ( isset( $wp_query->post->post_date ) )
				codium_light_date_classes( mysql2date( 'U', $wp_query->post->post_date ), $c, 's-' );
	
			// Adds category classes for each category on single posts
			if ( $cats = get_the_category() )
				foreach ( $cats as $cat )
					$c[] = 's-category-' . $cat->slug;
	
			// Adds tag classes for each tags on single posts
			if ( $tags = get_the_tags() )
				foreach ( $tags as $tag )
					$c[] = 's-tag-' . $tag->slug;
	
			// Adds MIME-specific classes for attachments
			if ( is_attachment() ) {
				$mime_type = get_post_mime_type();
				$mime_prefix = array( 'application/', 'image/', 'text/', 'audio/', 'video/', 'music/' );
					$c[] = 'attachmentid-' . $postID . ' attachment-' . str_replace( $mime_prefix, "", "$mime_type" );
			}
	
			// Adds author class for the post author
			$c[] = 's-author-' . sanitize_title_with_dashes(strtolower(get_the_author_meta('login')));
			rewind_posts();
		}
	
		// Author name classes for BODY on author archives
		elseif ( is_author() ) {
			$author = $wp_query->get_queried_object();
			$c[] = 'author';
			$c[] = 'author-' . $author->user_nicename;
		}
		
		// Category name classes for BODY on category archvies
		elseif ( is_category() ) {
			$cat = $wp_query->get_queried_object();
			$c[] = 'category';
			$c[] = 'category-' . $cat->slug;
		}
	
		// Tag name classes for BODY on tag archives
		elseif ( is_tag() ) {
			$tags = $wp_query->get_queried_object();
			$c[] = 'tag';
			$c[] = 'tag-' . $tags->slug;
		}
	
		// Page author for BODY on 'pages'
		elseif ( is_page() ) {
			$pageID = $wp_query->post->ID;
			$page_children = wp_list_pages("child_of=$pageID&echo=0");
			the_post();
			$c[] = 'page pageid-' . $pageID;
			$c[] = 'page-author-' . sanitize_title_with_dashes(strtolower(get_the_author()));
			// Checks to see if the page has children and/or is a child page; props to Adam
			if ( $page_children )
				$c[] = 'page-parent';
			if ( $wp_query->post->post_parent )
				$c[] = 'page-child parent-pageid-' . $wp_query->post->post_parent;
			if ( is_page_template() ) // Hat tip to Ian, themeshaper.com
				$c[] = 'page-template page-template-' . str_replace( '.php', '-php', get_post_meta( $pageID, '_wp_page_template', true ) );
			rewind_posts();
		}
	
		// Search classes for results or no results
		elseif ( is_search() ) {
			the_post();
			if ( have_posts() ) {
				$c[] = 'search-results';
			} else {
				$c[] = 'search-no-results';
			}
			rewind_posts();
		}
	
		// For when a visitor is logged in while browsing
		if ( $current_user->ID )
			$c[] = 'loggedin';
	
		// Paged classes; for 'page X' classes of index, single, etc.
		if ( ( ( $page = $wp_query->get('paged') ) || ( $page = $wp_query->get('page') ) ) && $page > 1 ) {
			// Thanks to Prentiss Riddle, twitter.com/pzriddle, for the security fix below.
			$page = intval($page); // Ensures that an integer (not some dangerous script) is passed for the variable
			$c[] = 'paged-' . $page;
			if ( is_single() ) {
				$c[] = 'single-paged-' . $page;
			} elseif ( is_page() ) {
				$c[] = 'page-paged-' . $page;
			} elseif ( is_category() ) {
				$c[] = 'category-paged-' . $page;
			} elseif ( is_tag() ) {
				$c[] = 'tag-paged-' . $page;
			} elseif ( is_date() ) {
				$c[] = 'date-paged-' . $page;
			} elseif ( is_author() ) {
				$c[] = 'author-paged-' . $page;
			} elseif ( is_search() ) {
				$c[] = 'search-paged-' . $page;
			}
		}
	
		// Separates classes with a single space, collates classes for BODY
		$c = join( ' ', apply_filters( 'body_class',  $c ) ); // Available filter: body_class
	
		// And tada!
		return $print ? print($c) : $c;
	}
	endif; // codium_light_body_class
	
	if ( ! function_exists( 'codium_light_post_class' ) ) :
	// Generates semantic classes for each post DIV element
	function codium_light_post_class( $print = true ) {
		global $post, $codium_light_post_alt;
	
		// hentry for hAtom compliace, gets 'alt' for every other post DIV, describes the post type and p[n]
		$c = array( 'hentry', "p$codium_light_post_alt", $post->post_type, $post->post_status );
	
		// Author for the post queried
		$c[] = 'author-' . sanitize_title_with_dashes(strtolower(get_the_author()));
	
		//If post is a sticky post
		if (is_sticky())
			$c[] = 'sticky';
	
		// Category for the post queried
		foreach ( (array) get_the_category() as $cat )
			$c[] = 'category-' . $cat->slug;
	
		// Tags for the post queried; if not tagged, use .untagged
		if ( get_the_tags() == null ) {
			$c[] = 'untagged';
		} else {
			foreach ( (array) get_the_tags() as $tag )
				$c[] = 'tag-' . $tag->slug;
		}
	
		// For password-protected posts
		if ( $post->post_password )
			$c[] = 'protected';
	
		// Applies the time- and date-based classes (below) to post DIV
		codium_light_date_classes( mysql2date( 'U', $post->post_date ), $c );
	
		// If it's the other to the every, then add 'alt' class
		if ( ++$codium_light_post_alt % 2 )
			$c[] = 'alt';
	
		// Separates classes with a single space, collates classes for post DIV
		$c = join( ' ', apply_filters( 'post_class', $c ) ); // Available filter: post_class
	
		// And tada!
		return $print ? print($c) : $c;
	}
	endif; // codium_light_post_class
	
	if ( ! function_exists( 'codium_light_date_classes' ) ) :
	// Generates time- and date-based classes for BODY, post DIVs, and comment LIs; relative to GMT (UTC)
	function codium_light_date_classes( $t, &$c, $p = '' ) {
		$t = $t + ( get_option('gmt_offset') * 3600 );
		$c[] = $p . 'y' . gmdate( 'Y', $t ); // Year
		$c[] = $p . 'm' . gmdate( 'm', $t ); // Month
		$c[] = $p . 'd' . gmdate( 'd', $t ); // Day
		$c[] = $p . 'h' . gmdate( 'H', $t ); // Hour
	}
	endif; // codium_light_date_classes
	
	if ( ! function_exists( 'codium_light_cats_meow' ) ) :
	// For category lists on category archives: Returns other categories except the current one (redundant)
	function codium_light_cats_meow($glue) {
		$current_cat = single_cat_title( '', false );
		$separator = "\n";
		$cats = explode( $separator, get_the_category_list($separator) );
		foreach ( $cats as $i => $str ) {
			if ( strstr( $str, ">$current_cat<" ) ) {
				unset($cats[$i]);
				break;
			}
		}
		if ( empty($cats) )
			return false;
	
		return trim(join( $glue, $cats ));
	}
	endif; // codium_light_cats_meow
	
	if ( ! function_exists( 'codium_light_tag_ur_it' ) ) :
	// For tag lists on tag archives: Returns other tags except the current one (redundant)
	function codium_light_tag_ur_it($glue) {
		$current_tag = single_tag_title( '', '',  false );
		$separator = "\n";
		$tags = explode( $separator, get_the_tag_list( "", "$separator", "" ) );
		foreach ( $tags as $i => $str ) {
			if ( strstr( $str, ">$current_tag<" ) ) {
				unset($tags[$i]);
				break;
			}
		}
		if ( empty($tags) )
			return false;
	
		return trim(join( $glue, $tags ));
	}
	endif; // codium_light_tag_ur_it
	
	if ( ! function_exists( 'codium_light_posted_on' ) ) :
	// data before post
	function codium_light_posted_on() {
		
		printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s.', 'codium_light' ),
			'meta-prep meta-prep-author',
			sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
				get_permalink(),
				esc_attr( get_the_time() ),
				get_the_date()
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				get_author_posts_url( get_the_author_meta( 'ID' ) ),
				sprintf( esc_attr__( 'View all posts by %s', 'codium_light' ), get_the_author() ),
				get_the_author()
			)
		);
	}
	endif;
	
	if ( ! function_exists( 'codium_light_posted_in' ) ) :
	// data after post
	function codium_light_posted_in() {
		// Retrieves tag list of current post, separated by commas.
		$tag_list = get_the_tag_list( '', ', ' );
		if ( $tag_list ) {
			$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'codium_light' );
		} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
			$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'codium_light' );
		} else {
			$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'codium_light' );
		}
		// Prints the string, replacing the placeholders.
		printf(
			$posted_in,
			get_the_category_list( ', ' ),
			$tag_list,
			get_permalink(),
			the_title_attribute( 'echo=0' )
		);
	}
	endif;
	
	if ( ! function_exists( 'codium_light_widgets_init' ) ) :
	// Widgets plugin: intializes the plugin after the widgets above have passed snuff
	function codium_light_widgets_init() {
	
	        register_sidebar(array(
			'name' => 'WidgetFooterLeft',
			'description' => 'Left Footer widget',
			'id'            => 'widgetfooterleft',
			'before_widget'  =>   "\n\t\t\t" . '',
			'after_widget'   =>   "\n\t\t\t<div class=\"clear\"></div><div class=\"center\"><div class=\"widgetseparator\"></div></div>\n",
			'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
			'after_title'    =>   "</h3>\n" .''
			));
	
	        register_sidebar(array(
			'name' => 'WidgetFooterCenter',
			'description' => 'Center Footer widget',
			'id'            => 'widgetfootercenter',
			'before_widget'  =>   "\n\t\t\t" . '',
			'after_widget'   =>   "\n\t\t\t<div class=\"clear\"></div><div class=\"center\"><div class=\"widgetseparator\"></div></div>\n",
			'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
			'after_title'    =>   "</h3>\n" .''
			));
	
	        register_sidebar(array(
			'name' => 'WidgetFooterRight',
			'description' => 'Right Footer widget',
			'id'            => 'widgetfooterright',
			'before_widget'  =>   "\n\t\t\t" . '',
			'after_widget'   =>   "\n\t\t\t<div class=\"clear\"></div><div class=\"center\"><div class=\"widgetseparator\"></div></div>\n",
			'before_title'   =>   "\n\t\t\t\t". '<h3 class="widgettitle">',
			'after_title'    =>   "</h3>\n" .''
			));
	
		}
	endif;
	
	add_action( 'widgets_init', 'codium_light_widgets_init' );
	
	if ( ! function_exists( 'codium_light_excerpt_more' ) ) :
	// Changes default [...] in excerpt to a real link
	function codium_light_excerpt_more($more) {
	       global $post;
	       $readmore = __(' read more <span class="meta-nav"></span>', 'codium_light' );
		return ' <a href="'. get_permalink($post->ID) . '">' . $readmore . '</a>';
	}
	endif;
	add_filter('excerpt_more', 'codium_light_excerpt_more');
	
	
	// Adds filters for the description/meta content in archives.php
	add_filter( 'archive_meta', 'wptexturize' );
	add_filter( 'archive_meta', 'convert_smilies' );
	add_filter( 'archive_meta', 'convert_chars' );
	add_filter( 'archive_meta', 'wpautop' );
	
	// Remember: the codium_light is for play.
	
	// footer link 
	add_action('wp_footer', 'footer_link');
	
	if ( ! function_exists( 'footer_link' ) ) :
	function footer_link() {	
	if ( is_front_page() && !is_paged()) {
		$powered = __( 'Powered by:', 'codium_light' );
	    $theme = __( 'by:', 'codium_light' );
	    $content = '<div class="credits entry-content-footer">Theme '.$theme.' <a href="http://codiumlight.promocode.fr/" title="Promo Code">Promo Code</a>, '.$powered.' <a href="http://wordpress.org" title="Wordpress">Wordpress</a></div>';
	  	echo $content;
	} else {
	    $powered = __( 'Powered by:', 'codium_light' );
	    $content = '<div class="credits container_15 entry-content-footer">'.$powered.' <a href="http://wordpress.org" title="Wordpress">Wordpress</a></div>';
	  	echo $content;
	}
	}
	endif;
	
	if ( ! function_exists( 'first_paragraph' ) ) :
	//add dropcap to the_content
	function first_paragraph($content){
	    return preg_replace('/<p([^>]+)?>/', '<p$1 class="dropcap normal">', $content, 1);
}
endif;
add_filter('the_content', 'first_paragraph');
if ( ! function_exists( 'cleanCut' ) ) :
//clean cut paragraph
function cleanCut($string,$length,$cutString = '...')
{
if(strlen($string) <= $length)
{
return $string;
}
$str = substr($string,0,$length-strlen($cutString)+1);
return substr($str,0,strrpos($str,' ')).$cutString;
}
endif;
?>