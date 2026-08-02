<?php
/**
 * Theme setup and assets.
 *
 * @package Cogpace
 */

/**
 * Enqueue the theme's scoped component styles.
 *
 * Global design tokens and element styles remain in theme.json.
 *
 * @return void
 */
function cogpace_enqueue_styles(): void {
	$theme = wp_get_theme();

	wp_enqueue_style(
		'cogpace-style',
		get_stylesheet_uri(),
		array(),
		$theme->get( 'Version' )
	);

	if ( is_page( 'explore-human-brain' ) ) {
		wp_enqueue_script_module(
			'cogpace-brain-experience',
			get_theme_file_uri( 'assets/js/brain-experience.js' ),
			array(),
			$theme->get( 'Version' )
		);
	}
}
add_action( 'wp_enqueue_scripts', 'cogpace_enqueue_styles' );

/**
 * Register the theme's pattern category.
 *
 * @return void
 */
function cogpace_register_pattern_categories(): void {
	register_block_pattern_category(
		'cogpace',
		array(
			'label'       => __( 'Cogpace', 'cogpace' ),
			'description' => __( 'Reusable Cogpace sections and cards.', 'cogpace' ),
		)
	);
}
add_action( 'init', 'cogpace_register_pattern_categories' );
