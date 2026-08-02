<?php
/**
 * Title: How Cogpace works
 * Slug: cogpace/how-it-works
 * Categories: cogpace
 * Keywords: process, steps, introduction
 * Viewport Width: 1200
 * Description: A three-step explanation of the Cogpace experience.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"full","className":"cogpace-home-flow","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull cogpace-home-flow">
	<!-- wp:group {"align":"wide","className":"cogpace-home-flow__inner","layout":{"type":"constrained"}} -->
	<div class="wp-block-group alignwide cogpace-home-flow__inner">
		<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
		<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'A simple rhythm', 'How it works eyebrow', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size"><?php echo esc_html_x( 'Understand. Practise. Reflect.', 'How it works heading', 'cogpace' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"text-muted"} -->
		<p class="has-text-muted-color has-text-color"><?php echo esc_html_x( 'Move between clear ideas and focused activities without turning a score into a judgement about your cognitive health.', 'How it works introduction', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<div class="cogpace-home-flow__steps">
			<div class="cogpace-home-flow__step">
				<span aria-hidden="true">01</span>
				<h3><?php echo esc_html_x( 'Understand', 'How it works step heading', 'cogpace' ); ?></h3>
				<p><?php echo esc_html_x( 'Read approachable, evidence-aware explanations about cognition and brain health.', 'How it works step copy', 'cogpace' ); ?></p>
			</div>
			<div class="cogpace-home-flow__step">
				<span aria-hidden="true">02</span>
				<h3><?php echo esc_html_x( 'Practise', 'How it works step heading', 'cogpace' ); ?></h3>
				<p><?php echo esc_html_x( 'Try a short browser-based activity with clear instructions and accessible controls.', 'How it works step copy', 'cogpace' ); ?></p>
			</div>
			<div class="cogpace-home-flow__step">
				<span aria-hidden="true">03</span>
				<h3><?php echo esc_html_x( 'Reflect', 'How it works step heading', 'cogpace' ); ?></h3>
				<p><?php echo esc_html_x( 'Notice strategies and patterns from the session, then carry the useful insight forward.', 'How it works step copy', 'cogpace' ); ?></p>
			</div>
		</div>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
