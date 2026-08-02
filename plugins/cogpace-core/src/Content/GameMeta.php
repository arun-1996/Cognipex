<?php
/**
 * Cognitive game metadata registration.
 *
 * @package CogpaceCore
 */

namespace Cogpace\Core\Content;

/**
 * Registers the public metadata contract for cognitive games.
 */
final class GameMeta {

	/**
	 * Registers the game metadata fields.
	 *
	 * @return void
	 */
	public static function register(): void {
		self::register_string( 'cogpace_game_key', 'sanitize_key' );
		self::register_string( 'cogpace_accessibility_notes', 'sanitize_textarea_field' );
		self::register_string( 'cogpace_evidence_reference', 'esc_url_raw' );
	}

	/**
	 * Registers a single string field for cognitive games.
	 *
	 * @param string   $key               Metadata key.
	 * @param callable $sanitize_callback Sanitization callback.
	 * @return void
	 */
	private static function register_string( string $key, callable $sanitize_callback ): void {
		register_post_meta(
			'cogpace_game',
			$key,
			array(
				'auth_callback'     => static function ( bool $allowed, string $meta_key, int $post_id ): bool {
					unset( $allowed, $meta_key );

					return current_user_can( 'edit_post', $post_id );
				},
				'default'           => '',
				'show_in_rest'      => true,
				'single'            => true,
				'sanitize_callback' => $sanitize_callback,
				'type'              => 'string',
			)
		);
	}
}
