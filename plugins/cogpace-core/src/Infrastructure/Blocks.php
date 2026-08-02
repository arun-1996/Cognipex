<?php
/**
 * Product block registration.
 *
 * @package CogpaceCore
 */

namespace Cogpace\Core\Infrastructure;

/**
 * Registers server-rendered Cogpace blocks.
 */
final class Blocks {

	/**
	 * Registers plugin blocks from their metadata.
	 *
	 * @return void
	 */
	public static function register(): void {
		register_block_type( dirname( __DIR__, 2 ) . '/blocks/focus-grid' );
		register_block_type( dirname( __DIR__, 2 ) . '/blocks/maze-navigator' );
		register_block_type( dirname( __DIR__, 2 ) . '/blocks/reaction-time' );
		register_block_type( dirname( __DIR__, 2 ) . '/blocks/rule-switch' );
		register_block_type( dirname( __DIR__, 2 ) . '/blocks/sequence-recall' );
		register_block_type( dirname( __DIR__, 2 ) . '/blocks/true-or-false' );
	}
}
