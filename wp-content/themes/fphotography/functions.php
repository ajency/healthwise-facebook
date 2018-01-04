<?php
/**
 * fPhotography functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @subpackage fPhotography
 * @author tishonator
 * @since fPhotography 1.0.0
 *
 */

require_once( trailingslashit( get_template_directory() ) . 'customize-pro/class-customize.php' );



if ( ! function_exists( 'fphotography_setup' ) ) :
/**
 * fPhotography setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 */
function fphotography_setup() {

	load_theme_textdomain( 'fphotography', get_template_directory() . '/languages' );

	add_theme_support( "title-tag" );

	// add the visual editor to resemble the theme style
	add_editor_style( array( 'css/editor-style.css', get_template_directory_uri() . '/css/font-awesome.min.css' ) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'fphotography' ),
	) );

	// add Custom background				 
	add_theme_support( 'custom-background', 
				   array ('default-color'  => '#FFFFFF')
				 );


	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 0, true );

	global $content_width;
	if ( ! isset( $content_width ) )
		$content_width = 900;

	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list',
	) );

	// add custom header
    add_theme_support( 'custom-header', array (
                       'default-image'          => '',
                       'random-default'         => '',
                       'flex-height'            => true,
                       'flex-width'             => true,
                       'uploads'                => true,
                       'width'                  => 900,
                       'height'                 => 100,
                       'default-text-color'        => '#000000',
                       'wp-head-callback'       => 'fphotography_header_style',
                    ) );

    // add custom logo
    add_theme_support( 'custom-logo', array (
                       'width'                  => 145,
                       'height'                 => 36,
                       'flex-height'            => true,
                       'flex-width'             => true,
                    ) );
}
endif; // fphotography_setup
add_action( 'after_setup_theme', 'fphotography_setup' );

/**
 * the main function to load scripts in the fPhotography theme
 * if you add a new load of script, style, etc. you can use that function
 * instead of adding a new wp_enqueue_scripts action for it.
 */
function fphotography_load_scripts() {

	// load main stylesheet.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( ) );
	wp_enqueue_style( 'fphotography-style', get_stylesheet_uri(), array( ) );
	
	wp_enqueue_style( 'fphotography-fonts', fphotography_fonts_url(), array(), null );
	
	// Load thread comments reply script
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
	
	// Load Utilities JS Script
	wp_enqueue_script( 'fphotography-js', get_template_directory_uri() . '/js/utilities.js', array( 'jquery' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'classie', get_template_directory_uri() . '/js/classie.js', array( 'jquery' ) );
	wp_enqueue_script( 'photostack', get_template_directory_uri() . '/js/photostack.js', array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'fphotography_load_scripts' );

/**
 *	Load google font url used in the fPhotography theme
 */
function fphotography_fonts_url() {

    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by PT Alegreya Sans SC, translate this to 'off'. Do not translate
    * into your own language.
    */
    $cantarell = _x( 'on', 'Alegreya Sans SC font: on or off', 'fphotography' );

    if ( 'off' !== $cantarell ) {
        $font_families = array();
 
        $font_families[] = 'Alegreya Sans SC';
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }
 
    return $fonts_url;
}

/**
 *	Used to load the content for posts and pages.
 */
function fphotography_the_content() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {
?>

		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
								
<?php
	}
	the_content( __( 'Read More', 'fphotography') );
}

/**
 * Display website's logo image
 */
function fphotography_show_website_logo_image_and_title() {

	if ( has_custom_logo() ) {

        the_custom_logo();
    }

    $header_text_color = get_header_textcolor();

    if ( 'blank' !== $header_text_color ) {
    
        echo '<div id="site-identity">';
        echo '<a href="' . esc_url( home_url('/') ) . '" title="' . esc_attr( get_bloginfo('name') ) . '">';
        echo '<h1 class="entry-title">'.get_bloginfo('name').'</h1>';
        echo '</a>';
        echo '<strong>'.get_bloginfo('description').'</strong>';
        echo '</div>';
    }
}

/**
 *	Displays the copyright text.
 */
function fphotography_show_copyright_text() {

	$footerText = get_theme_mod('fphotography_footer_copyright', null);

	if ( !empty( $footerText ) ) {

		echo esc_html( $footerText ) . ' | ';		
	}
}

/**
 *	widgets-init action handler. Used to register widgets and register widget areas
 */
function fphotography_widgets_init() {
	
	// Register Sidebar Widget.
	register_sidebar( array (
						'name'	 		 =>	 __( 'Sidebar Widget Area', 'fphotography'),
						'id'		 	 =>	 'sidebar-widget-area',
						'description'	 =>  __( 'The sidebar widget area', 'fphotography'),
						'before_widget'	 =>  '',
						'after_widget'	 =>  '',
						'before_title'	 =>  '<div class="sidebar-before-title"></div><h3 class="sidebar-title">',
						'after_title'	 =>  '</h3><div class="sidebar-after-title"></div>',
					) );

	// Register Footer Column #1
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #1', 'fphotography' ),
							'id' 			 =>  'footer-column-1-widget-area',
							'description'	 =>  __( 'The Footer Column #1 widget area', 'fphotography' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #2
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #2', 'fphotography' ),
							'id' 			 =>  'footer-column-2-widget-area',
							'description'	 =>  __( 'The Footer Column #2 widget area', 'fphotography' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
	
	// Register Footer Column #3
	register_sidebar( array (
							'name'			 =>  __( 'Footer Column #3', 'fphotography' ),
							'id' 			 =>  'footer-column-3-widget-area',
							'description'	 =>  __( 'The Footer Column #3 widget area', 'fphotography' ),
							'before_widget'  =>  '',
							'after_widget'	 =>  '',
							'before_title'	 =>  '<h2 class="footer-title">',
							'after_title'	 =>  '</h2><div class="footer-after-title"></div>',
						) );
}

add_action( 'widgets_init', 'fphotography_widgets_init' );

/**
 * Displays the slider
 */
function fphotography_display_slider() { ?>

	<div class="slider-container" id="slider-container">
		<section id="photostack" class="photostack">
			<div>
				<?php
					// display slides
					for ( $i = 1; $i <= 5; ++$i ) {
						$defaultSlideContent = __( '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'fphotography' );
					
						$defaultSlideImage = get_template_directory_uri().'/images/slider/' . $i .'.jpg';
						$slideImage = get_theme_mod( 'fphotography_slide'.$i.'_image', $defaultSlideImage );

						if ( !empty($slideImage) ) :

							$slideContent = get_theme_mod( 'fphotography_slide'.$i.'_content', html_entity_decode( $defaultSlideContent ) );	
							$imageAlt = sprintf( __( 'Image %s', 'fphotography' ), $i );
				?>

							<figure>
								<img src="<?php echo esc_url( $slideImage ); ?>" alt="<?php echo esc_attr( $imageAlt ); ?>" />
								<figcaption>
									<div class="photostack-back">
										<?php echo $slideContent; ?>									
									</div>
								</figcaption>
							</figure>


				<?php 	endif;

					} ?>
			</div>
		</section>
	</div><!-- #slider-container -->

<?php  
}

/**
 *	Displays the single content.
 */
function fphotography_the_content_single() {

	// Display Thumbnails if thumbnail is set for the post
	if ( has_post_thumbnail() ) {

		the_post_thumbnail();
	}
	the_content( __( 'Read More...', 'fphotography') );
}

/**
 * Register theme settings in the customizer
 */
function fphotography_customize_register( $wp_customize ) {
	
	/**
	 * Add Slider Section
	 */
	$wp_customize->add_section(
		'fphotography_slider_section',
		array(
			'title'       => __( 'Slider', 'fphotography' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add slide 1 content
	$wp_customize->add_setting(
		'fphotography_slide1_content',
		array(
		    'default'           => __( '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'fphotography' ),
		    'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fphotography_slide1_content',
        array(
            'label'          => __( 'Slide #1 Content', 'fphotography' ),
            'section'        => 'fphotography_slider_section',
            'settings'       => 'fphotography_slide1_content',
            'type'           => 'textarea',
            )
        )
	);
	
	// Add slide 1 background image
	$wp_customize->add_setting( 'fphotography_slide1_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '1.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fphotography_slide1_image',
			array(
				'label'   	 => __( 'Slide 1 Image (Recommended Size: 240px x 240px)', 'fphotography' ),
				'section' 	 => 'fphotography_slider_section',
				'settings'   => 'fphotography_slide1_image',
			) 
		)
	);
	
	// Add slide 2 content
	$wp_customize->add_setting(
		'fphotography_slide2_content',
		array(
		    'default'           => __( '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'fphotography' ),
		    'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fphotography_slide2_content',
        array(
            'label'          => __( 'Slide #2 Content', 'fphotography' ),
            'section'        => 'fphotography_slider_section',
            'settings'       => 'fphotography_slide2_content',
            'type'           => 'textarea',
            )
        )
	);
	
	// Add slide 2 background image
	$wp_customize->add_setting( 'fphotography_slide2_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '2.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fphotography_slide2_image',
			array(
				'label'   	 => __( 'Slide 2 Image (Recommended Size: 240px x 240px)', 'fphotography' ),
				'section' 	 => 'fphotography_slider_section',
				'settings'   => 'fphotography_slide2_image',
			) 
		)
	);
	
	// Add slide 3 content
	$wp_customize->add_setting(
		'fphotography_slide3_content',
		array(
		    'default'           => __( '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'fphotography' ),
		    'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fphotography_slide3_content',
        array(
            'label'          => __( 'Slide #3 Content', 'fphotography' ),
            'section'        => 'fphotography_slider_section',
            'settings'       => 'fphotography_slide3_content',
            'type'           => 'textarea',
            )
        )
	);
	
	// Add slide 3 background image
	$wp_customize->add_setting( 'fphotography_slide3_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '3.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fphotography_slide3_image',
			array(
				'label'   	 => __( 'Slide 3 Image (Recommended Size: 240px x 240px)', 'fphotography' ),
				'section' 	 => 'fphotography_slider_section',
				'settings'   => 'fphotography_slide3_image',
			) 
		)
	);

	// Add slide 4 content
	$wp_customize->add_setting(
		'fphotography_slide4_content',
		array(
		    'default'           => __( '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'fphotography' ),
		    'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fphotography_slide4_content',
        array(
            'label'          => __( 'Slide #4 Content', 'fphotography' ),
            'section'        => 'fphotography_slider_section',
            'settings'       => 'fphotography_slide4_content',
            'type'           => 'textarea',
            )
        )
	);
	
	// Add slide 4 background image
	$wp_customize->add_setting( 'fphotography_slide4_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '4.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fphotography_slide4_image',
			array(
				'label'   	 => __( 'Slide 4 Image (Recommended Size: 240px x 240px)', 'fphotography' ),
				'section' 	 => 'fphotography_slider_section',
				'settings'   => 'fphotography_slide4_image',
			) 
		)
	);

	// Add slide 5 content
	$wp_customize->add_setting(
		'fphotography_slide5_content',
		array(
		    'default'           => __( '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>', 'fphotography' ),
		    'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fphotography_slide5_content',
        array(
            'label'          => __( 'Slide #5 Content', 'fphotography' ),
            'section'        => 'fphotography_slider_section',
            'settings'       => 'fphotography_slide5_content',
            'type'           => 'textarea',
            )
        )
	);
	
	// Add slide 5 background image
	$wp_customize->add_setting( 'fphotography_slide5_image',
		array(
			'default' => get_template_directory_uri().'/images/slider/' . '5.jpg',
    		'sanitize_callback' => 'esc_url_raw'
		)
	);

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fphotography_slide5_image',
			array(
				'label'   	 => __( 'Slide 5 Image (Recommended Size: 240px x 240px)', 'fphotography' ),
				'section' 	 => 'fphotography_slider_section',
				'settings'   => 'fphotography_slide5_image',
			) 
		)
	);

	/**
	 * Add Footer Section
	 */
	$wp_customize->add_section(
		'fphotography_footer_section',
		array(
			'title'       => __( 'Footer', 'fphotography' ),
			'capability'  => 'edit_theme_options',
		)
	);
	
	// Add footer copyright text
	$wp_customize->add_setting(
		'fphotography_footer_copyright',
		array(
		    'default'           => '',
		    'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'fphotography_footer_copyright',
        array(
            'label'          => __( 'Copyright Text', 'fphotography' ),
            'section'        => 'fphotography_footer_section',
            'settings'       => 'fphotography_footer_copyright',
            'type'           => 'text',
            )
        )
	);
}

add_action('customize_register', 'fphotography_customize_register');

function fphotography_header_style() {

    $header_text_color = get_header_textcolor();

    if ( ! has_header_image()
        && ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color
             || 'blank' === $header_text_color ) ) {

        return;
    }

    $headerImage = get_header_image();
?>
    <style type="text/css">
        <?php if ( has_header_image() ) : ?>

                #header-main-fixed {background-image: url("<?php echo esc_url( $headerImage ); ?>");}

        <?php endif; ?>

        <?php if ( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color
                    && 'blank' !== $header_text_color ) : ?>

                #header-main-fixed, #header-main-fixed h1.entry-title {color: #<?php echo esc_attr( $header_text_color ); ?>;}

        <?php endif; ?>
    </style>
<?php
}

?>
