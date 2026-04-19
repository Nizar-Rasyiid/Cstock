<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package consultica
 * @since 1.0.0
 */

/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */

if (! function_exists('consultica_support')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */

	function consultica_support()
	{

		add_editor_style(get_template_directory_uri() . '/assets/css/editor.css');

		load_theme_textdomain('consultica', get_template_directory() . '/languages');

		// Add support for block styles.
		add_theme_support('wp-block-styles');

		// Add support for post thumbnails
		add_theme_support('post-thumbnails');
	}

endif;
add_action('after_setup_theme', 'consultica_support');

function consultica_styles()
{
	wp_enqueue_style(
		'consultica-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get('Version')
	);

	wp_enqueue_style(
		'consultica-font-awesome',
		get_template_directory_uri() . '/assets/css/font-awesome/css/all.css',
		[],
		wp_get_theme()->get('Version')
	);

	wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'consultica_styles');

// admin style
function consultica_admin_styles()
{
	wp_enqueue_style(
		'consultica-admin-style',
		get_template_directory_uri() . '/assets/css/theme-info.css',
		[],
		wp_get_theme()->get('Version')
	);
}
add_action('admin_enqueue_scripts', 'consultica_admin_styles');

// enqueue dashicons
add_action('enqueue_block_assets', function (): void {
	wp_enqueue_style('dashicons');
});

function consultica_excerpt_length($length)
{

	$excerpt_length = 20;
	if (is_admin()) return $length;
	return $excerpt_length;
}
add_filter('excerpt_length', 'consultica_excerpt_length');


// add block patterns
require get_template_directory() . '/inc/block-patterns.php';

// admin Info
require get_template_directory() . '/class/admin-info.php';

/**
 * Register block styles.
 */

if (! function_exists('consultica_block_styles')) :
	/**
	 * Register custom block styles
	 *
	 * @since Consulticae
	 * @return void
	 */
	function consultica_block_styles()
	{

		register_block_style(
			'core/paragraph',
			array(
				'name'         => 'admin-icon',
				'label'        => __('Admin Icon', 'consultica'),
				/*
				 * Styles for the custom Arrow icon style of the Details block
				 */
				'inline_style' => '
				.is-style-admin-icon:before {
					content: "\f110";
					font-family: "dashicons";
				}
				.is-style-admin-icon span{
					display: none;
				}',
			)
		);
	}
endif;

add_action('init', 'consultica_block_styles');
