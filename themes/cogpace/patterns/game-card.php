<?php
/**
 * Title: Game card
 * Slug: cogpace/game-card
 * Categories: cogpace
 * Block Types: core/post-template
 * Keywords: game, practice, card
 * Description: A query-compatible cognitive game summary card.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"className":"cogpace-card cogpace-game-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-card cogpace-game-card">
	<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
	<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Cognitive game', 'Game card eyebrow', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:post-title {"isLink":true,"level":2,"fontSize":"large"} /-->

	<!-- wp:post-excerpt {"moreText":"Start","showMoreOnNewLine":true} /-->
</div>
<!-- /wp:group -->
