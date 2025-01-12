<?php
/**
 * Marker Child functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Marker Child
 */

/**
 * This enqueues the parent and child theme stylesheets.
 * https://codex.wordpress.org/Child_Themes
 */
function theme_enqueue_styles() {

	$parent_style = 'parent-style';

	wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-style',
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style )
	);
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
