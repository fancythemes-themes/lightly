<?php
/**
 * Lightly only works in WordPress 4.5 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.5', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}


if ( ! function_exists( 'lightly_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function lightly_setup() {

		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 * If you're building a theme based on lightly, use a find and replace
		 * to change 'lightly' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'lightly', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for custom logo.
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 90,
			'width'       => 342,
			'flex-height' => true,
		) );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300, 200, true );

		/**
		 * Switch default core markup to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/**
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'status',
			'audio',
			'chat',
		) );

		/**
		 * This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus( array(
			'primary'   => esc_html__( 'Primary Menu', 'lightly' ),
			'footer'    => esc_html__( 'Footer Menu', 'lightly' ),
		) );

		/**
		 * Adding styling to the editor
		 */
		add_editor_style( 'style-editor.css' );

		/**
		 * Remove Default CSS for gallery
		 */
		add_filter( 'use_default_gallery_style', '__return_false' );
	}

endif;

add_action( 'after_setup_theme', 'lightly_setup' );


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lightly_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lightly_content_width', 710 );
}

add_action( 'after_setup_theme', 'lightly_content_width', 0 );


/**
 * Setup the WordPress core custom background feature.
 */
function lightly_register_custom_background() {

	add_theme_support( 'custom-background', apply_filters( 'lightly_custom_background_args', array(
		'default-color' => 'eee',
	) ) );

}

add_action( 'after_setup_theme', 'lightly_register_custom_background' );


/**
 * Sidebars & Widget Areas
 */
function lightly_register_sidebars() {
	register_sidebar( array(
		'id'            => 'sidebar-1',
		'name'          => esc_html__( 'Sidebar', 'lightly' ),
		'description'   => esc_html__( 'The first (primary) sidebar.', 'lightly' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle"><span>',
		'after_title'   => '</span></h4>'
	) );

	register_sidebar( array(
		'id'            => 'footer-sidebar-1',
		'name'          => esc_html__( 'Footer Sidebar 1', 'lightly' ),
		'description'   => esc_html__( 'First footer widget area.', 'lightly' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle"><span>',
		'after_title'   => '</span></h4>',
		'empty_title'   => '<h4 class="widgettitle hide-title"><span>',
	) );

	register_sidebar( array(
		'id'            => 'footer-sidebar-2',
		'name'          => esc_html__( 'Footer Sidebar 2', 'lightly' ),
		'description'   => esc_html__( 'Second footer widget area', 'lightly' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle"><span>',
		'after_title'   => '</span></h4>',
		'empty_title'   => '<h4 class="widgettitle hide-title"><span>',
	) );

	register_sidebar( array(
		'id'            => 'footer-sidebar-3',
		'name'          => esc_html__( 'Footer Sidebar 3', 'lightly' ),
		'description'   => esc_html__( 'Third footer widget area', 'lightly' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle"><span>',
		'after_title'   => '</span></h4>',
		'empty_title'   => '<h4 class="widgettitle hide-title"><span>',
	) );

	register_sidebar( array(
		'id'            => 'footer-sidebar-4',
		'name'          => esc_html__( 'Footer Sidebar 4', 'lightly' ),
		'description'   => esc_html__( 'Fourth footer widget area', 'lightly' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle"><span>',
		'after_title'   => '</span></h4>',
		'empty_title'   => '<h4 class="widgettitle hide-title"><span>',
	) );

	register_sidebar( array(
		'id'            => 'header-sidebar',
		'name'          => esc_html__( 'Header Sidebar', 'lightly' ),
		'description'   => esc_html__( 'Widget area on the header, best use for advertisement.', 'lightly' ),
		'before_widget' => '<div id="%1$s" class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widgettitle"><span>',
		'after_title'   => '</span></h4>'
	) );
}

add_action( 'widgets_init', 'lightly_register_sidebars' );


/**
 * Enqueue scripts and styles
 */
function lightly_scripts() {

	/**
	 * Load FontAwesome
	 */
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );

	/**
	 * Load Theme Style
	 */
	wp_enqueue_style( 'lightly-style', get_stylesheet_uri() );

	/**
	 * Conditionally Load style for IE
	 */
	wp_enqueue_style( 'lightly-ie', get_template_directory_uri() . '/css/ie.css', array('lightly-style') );
	wp_style_add_data( 'lightly-ie', 'conditional', 'lt IE 8' );

	/**
	 * Conditionally Load Scripts
	 */
	wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/vendor/html5shiv.min.js', array(), '20160722' );
	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'selectivizr', get_template_directory_uri() . '/js/vendor/selectivizr.min.js', array(), '20160722' );
	wp_script_add_data( 'selectivizr', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/vendor/respond.min.js', array(), '20160722' );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	/**
	 * Load Theme Scripts
	 */
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/vendor/jquery.fitvids.min.js', array( 'jquery' ), '1.1', true );
	wp_enqueue_script( 'lightly-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery', 'jquery-fitvids' ), '1.25', true );

	/**
	 * Load Script for Threaded Comments
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$js_settings = array();

	//
	// slider

	if ( ! get_theme_mod( 'featured_slider_auto_slide' ) ) {
		$js_settings['slider']['autoPlay'] = false;
	} else {
		$js_settings['slider']['autoPlay'] = true;
	}
	if ( ! get_theme_mod( 'featured_slider_auto_slide_timer' ) ) {
		$js_settings['slider']['delay'] = 5000;
	} else  {
		$js_settings['slider']['delay'] = intval( get_theme_mod( 'featured_slider_auto_slide_timer' ) . '000' );
	}

	// Pass to the JavaScript
	wp_localize_script(
		'lightly-script',
		'_lightlyJS',
		$js_settings
	);
}

add_action( 'wp_enqueue_scripts', 'lightly_scripts' );


if ( ! function_exists( 'lightly_load_font' ) ) {
	/**
	 * Google/Web Fonts for Lightly
	 */
	function lightly_load_font() {

		$default_font = array(
			'body_font'    => 'Lato__100,100italic,300,300italic,400,400italic,700,700italic,900,900italic',
			'heading_font' => 'Copse__400',
			'menu_font'    => 'Copse__400',
		);

		$added = array();

		foreach ( $default_font as $section => $font_to_load ) {

			if ( ! in_array( $font_to_load, $added ) ) {
				$added[]      = $font_to_load;
				$font_to_load = str_replace( '__', ':', $font_to_load );
				$font_id      = substr( $font_to_load, 0, strpos( $font_to_load, ':' ) );
				$font_to_load = str_replace( '_', '+', $font_to_load );
				$font_url     = 'http://fonts.googleapis.com/css?family=' . $font_to_load;

				wp_enqueue_style( 'google-font-' . strtolower( $font_id ), $font_url );
			}
		}

	}

}

add_action( 'wp_enqueue_scripts', 'lightly_load_font' );


/**
 * Registers Widgets
 */
function lightly_register_widgets() {

	require( get_template_directory() . '/inc/widgets/recent_comments.php' );
	require( get_template_directory() . '/inc/widgets/recent_posts.php' );
	require( get_template_directory() . '/inc/widgets/tabs.php' );

	register_widget( 'Lightly_Widget_Recent_Comments' );
	register_widget( 'Lightly_Widget_Recent_Posts' );
	register_widget( 'Lightly_Widget_Tabs' );
}

add_action( 'widgets_init', 'lightly_register_widgets' );


/**
 * Custom template tags for this theme.
 */
require( get_template_directory() . '/inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates
 */
require( get_template_directory() . '/inc/extras.php' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-helper.php';
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme Dashboard Page
 */
require get_template_directory() . '/inc/dashboard.php';
