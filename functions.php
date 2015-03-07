<?php
/**
 * Marker Child functions and definitions
 *
 * @package Marker Child
 */

 /**
 * This enqueues the parent and child theme stylesheets.
 * http://codex.wordpress.org/Child_Themes
 */
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 730; /* pixels */
}

if ( ! function_exists( 'marker_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function marker_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Marker, use a find and replace
	 * to change 'marker' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'marker', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top' => __( 'Top Menu', 'marker' ),
		'primary' => __( 'Primary Menu', 'marker' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );
	 */

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'marker_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // marker_setup
add_action( 'after_setup_theme', 'marker_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function marker_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Widget Area', 'marker' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<span class="widget-title">',
		'after_title'   => '</span>',
	) );
	
	register_sidebar( array(
        'name'			=> __( 'Footer Widget Area', 'marker' ),
        'id'			=> 'sidebar-2',
		'description'   => '',
        'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
        'after_widget'	=> '</aside>',
        'before_title'	=> '<span class="widget-title">',
        'after_title'	=> '</span>',
    ) );
}
add_action( 'widgets_init', 'marker_widgets_init' );