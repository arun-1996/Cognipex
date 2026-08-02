<?php
/**
 * Title: Five-minute practice
 * Slug: cogpace/five-minute-practice
 * Categories: cogpace
 * Keywords: practice, game, featured, action
 * Viewport Width: 1200
 * Description: A prominent short-practice entry point for the homepage.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"wide","className":"cogpace-five-minute","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide cogpace-five-minute">
	<div class="cogpace-five-minute__copy">
		<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
		<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Start with five minutes', 'Five-minute practice eyebrow', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size"><?php echo esc_html_x( 'Build and recall a short sequence', 'Five-minute practice heading', 'cogpace' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"text-muted"} -->
		<p class="has-text-muted-color has-text-color"><?php echo esc_html_x( 'Sequence Recall gives you five progressively longer rounds. Watch the numbered shapes, hold the order in mind, and rebuild it at your own pace.', 'Five-minute practice description', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/practise/sequence-recall/' ) ); ?>"><?php echo esc_html_x( 'Start Sequence Recall', 'Five-minute practice action', 'cogpace' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>

	<div class="cogpace-five-minute__details">
		<p class="cogpace-five-minute__label"><?php echo esc_html_x( 'Session snapshot', 'Five-minute practice metadata heading', 'cogpace' ); ?></p>
		<ul>
			<li><span><?php echo esc_html_x( 'Time', 'Five-minute practice metadata label', 'cogpace' ); ?></span><strong><?php echo esc_html_x( 'About 5 minutes', 'Five-minute practice time value', 'cogpace' ); ?></strong></li>
			<li><span><?php echo esc_html_x( 'Focus', 'Five-minute practice metadata label', 'cogpace' ); ?></span><strong><?php echo esc_html_x( 'Working memory', 'Five-minute practice focus value', 'cogpace' ); ?></strong></li>
			<li><span><?php echo esc_html_x( 'Format', 'Five-minute practice metadata label', 'cogpace' ); ?></span><strong><?php echo esc_html_x( '5 rounds', 'Five-minute practice format value', 'cogpace' ); ?></strong></li>
			<li><span><?php echo esc_html_x( 'Privacy', 'Five-minute practice metadata label', 'cogpace' ); ?></span><strong><?php echo esc_html_x( 'Session-only result', 'Five-minute practice privacy value', 'cogpace' ); ?></strong></li>
		</ul>
	</div>
</div>
<!-- /wp:group -->
