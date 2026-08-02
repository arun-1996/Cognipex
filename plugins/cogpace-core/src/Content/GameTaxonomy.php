<?php
/**
 * Cognitive domain taxonomy registration.
 *
 * @package CogpaceCore
 */

namespace Cogpace\Core\Content;

/**
 * Registers the shared cognitive domain vocabulary.
 */
final class GameTaxonomy {

	/**
	 * Registers the cognitive domain taxonomy for articles and games.
	 *
	 * @return void
	 */
	public static function register(): void {
		$labels = array(
			'name'          => _x( 'Cognitive Domains', 'Taxonomy general name', 'cogpace-core' ),
			'singular_name' => _x( 'Cognitive Domain', 'Taxonomy singular name', 'cogpace-core' ),
			'search_items'  => __( 'Search Cognitive Domains', 'cogpace-core' ),
			'all_items'     => __( 'All Cognitive Domains', 'cogpace-core' ),
			'edit_item'     => __( 'Edit Cognitive Domain', 'cogpace-core' ),
			'update_item'   => __( 'Update Cognitive Domain', 'cogpace-core' ),
			'add_new_item'  => __( 'Add New Cognitive Domain', 'cogpace-core' ),
			'new_item_name' => __( 'New Cognitive Domain Name', 'cogpace-core' ),
			'menu_name'     => __( 'Cognitive Domains', 'cogpace-core' ),
		);

		register_taxonomy(
			'cogpace_cognitive_domain',
			array( 'post', 'cogpace_game' ),
			array(
				'labels'             => $labels,
				'public'             => true,
				'publicly_queryable' => true,
				'hierarchical'       => false,
				'show_admin_column'  => true,
				'show_in_rest'       => true,
				'rewrite'            => array(
					'slug'       => 'cognitive-domain',
					'with_front' => false,
				),
			)
		);
	}
}
