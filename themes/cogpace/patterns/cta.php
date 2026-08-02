<?php
/**
 * Title: Call to action
 * Slug: cogpace/cta
 * Categories: cogpace
 * Keywords: call to action, button
 * Description: A restrained call-to-action section with one primary link.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"wide","className":"cogpace-cta","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignwide cogpace-cta">
	<!-- wp:heading {"level":2,"fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-x-large-font-size"><?php echo esc_html_x( 'Continue exploring', 'Call-to-action heading', 'cogpace' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"textColor":"text-muted"} -->
	<p class="has-text-muted-color has-text-color"><?php echo esc_html_x( 'Choose the next useful step for your learning or practice.', 'Call-to-action description', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/practise/"><?php echo esc_html_x( 'Explore practice', 'Call-to-action link', 'cogpace' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
