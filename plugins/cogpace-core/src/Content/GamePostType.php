<?php
/**
 * Cognitive game post type registration.
 *
 * @package CogpaceCore
 */

namespace Cogpace\Core\Content;

/**
 * Registers the public cognitive game catalogue.
 */
final class GamePostType {

	/**
	 * Registers the cognitive game post type.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'                  => _x( 'Cognitive Games', 'Post type general name', 'cogpace-core' ),
			'singular_name'         => _x( 'Cognitive Game', 'Post type singular name', 'cogpace-core' ),
			'menu_name'             => _x( 'Cognitive Games', 'Admin menu text', 'cogpace-core' ),
			'name_admin_bar'        => _x( 'Cognitive Game', 'Add new on admin bar', 'cogpace-core' ),
			'add_new'               => __( 'Add New', 'cogpace-core' ),
			'add_new_item'          => __( 'Add New Cognitive Game', 'cogpace-core' ),
			'new_item'              => __( 'New Cognitive Game', 'cogpace-core' ),
			'edit_item'             => __( 'Edit Cognitive Game', 'cogpace-core' ),
			'view_item'             => __( 'View Cognitive Game', 'cogpace-core' ),
			'all_items'             => __( 'Cognitive Games', 'cogpace-core' ),
			'search_items'          => __( 'Search Cognitive Games', 'cogpace-core' ),
			'not_found'             => __( 'No cognitive games found.', 'cogpace-core' ),
			'not_found_in_trash'    => __( 'No cognitive games found in Trash.', 'cogpace-core' ),
			'featured_image'        => _x( 'Cognitive Game Image', 'Featured image label', 'cogpace-core' ),
			'set_featured_image'    => _x( 'Set cognitive game image', 'Set featured image label', 'cogpace-core' ),
			'remove_featured_image' => _x( 'Remove cognitive game image', 'Remove featured image label', 'cogpace-core' ),
			'use_featured_image'    => _x( 'Use as cognitive game image', 'Use featured image label', 'cogpace-core' ),
			'archives'              => _x( 'Cognitive Game Archives', 'Post type archive label', 'cogpace-core' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_in_rest'       => true,
			'show_in_nav_menus'  => true,
			'has_archive'        => 'practise',
			'rewrite'            => array(
				'slug'       => 'practise',
				'with_front' => false,
			),
			'menu_icon'          => 'dashicons-controls-play',
			'capability_type'    => 'post',
			'map_meta_cap'       => true,
			'delete_with_user'   => false,
			'supports'           => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail',
				'custom-fields',
			),
		);

		register_post_type( 'cogpace_game', $args );
	}
}
