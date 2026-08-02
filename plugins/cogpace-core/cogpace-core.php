<?php
/**
 * Plugin Name:       Cogpace Core
 * Description:       Core product foundation for Cogpace.
 * Version:           0.7.1
 * Requires at least: 7.0
 * Requires PHP:      8.2
 * Author:            Cogpace
 * Text Domain:       cogpace-core
 *
 * @package CogpaceCore
 */

namespace Cogpace\Core;

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/src/Content/GamePostType.php';
require_once __DIR__ . '/src/Content/GameTaxonomy.php';
require_once __DIR__ . '/src/Content/GameMeta.php';
require_once __DIR__ . '/src/Content/InformationPages.php';
require_once __DIR__ . '/src/Infrastructure/Blocks.php';

add_action( 'init', array( Content\GamePostType::class, 'register' ) );
add_action( 'init', array( Content\GameTaxonomy::class, 'register' ) );
add_action( 'init', array( Content\GameMeta::class, 'register' ) );
add_action( 'init', array( Content\InformationPages::class, 'provision' ), 20 );
add_action( 'init', array( Infrastructure\Blocks::class, 'register' ) );
add_action( 'template_redirect', array( Content\InformationPages::class, 'redirect_legacy_route' ) );

/**
 * Registers plugin requirements needed before activation completes.
 *
 * @return void
 */
function activate(): void {
	Content\GamePostType::register();
	flush_rewrite_rules();
}

/**
 * Removes generated rewrite rules when the plugin is deactivated.
 *
 * @return void
 */
function deactivate(): void {
	flush_rewrite_rules();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\\activate' );
register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivate' );
