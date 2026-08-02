<?php
/**
 * Title: Editorial trust
 * Slug: cogpace/editorial-trust
 * Categories: cogpace
 * Keywords: evidence, privacy, trust, editorial
 * Viewport Width: 1200
 * Description: A concise explanation of the product's evidence and privacy boundaries.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"full","className":"cogpace-editorial-trust","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull cogpace-editorial-trust">
	<!-- wp:group {"align":"wide","className":"cogpace-editorial-trust__inner","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cogpace-editorial-trust__inner">
		<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
		<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Thoughtful by design', 'Editorial trust eyebrow', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size"><?php echo esc_html_x( 'Clear evidence. Clear boundaries.', 'Editorial trust heading', 'cogpace' ); ?></h2>
		<!-- /wp:heading -->

		<div class="cogpace-editorial-trust__points">
			<div><h3><?php echo esc_html_x( 'Evidence-aware', 'Editorial trust point heading', 'cogpace' ); ?></h3><p><?php echo esc_html_x( 'Material scientific claims are supported with reviewable sources and uncertainty is stated plainly.', 'Editorial trust point copy', 'cogpace' ); ?></p></div>
			<div><h3><?php echo esc_html_x( 'Educational, not diagnostic', 'Editorial trust point heading', 'cogpace' ); ?></h3><p><?php echo esc_html_x( 'Articles and activities are for general education. A game score is never presented as a clinical result.', 'Editorial trust point copy', 'cogpace' ); ?></p></div>
			<div><h3><?php echo esc_html_x( 'Private by default', 'Editorial trust point heading', 'cogpace' ); ?></h3><p><?php echo esc_html_x( 'Current activities require no account and keep results only for the active browser session.', 'Editorial trust point copy', 'cogpace' ); ?></p></div>
		</div>

		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-outline"} -->
			<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php echo esc_html_x( 'Read evidence-aware articles', 'Editorial trust action', 'cogpace' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
