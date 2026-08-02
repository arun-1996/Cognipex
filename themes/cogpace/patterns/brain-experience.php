<?php
/**
 * Title: Interactive brain experience
 * Slug: cogpace/brain-experience
 * Categories: cogpace
 * Keywords: brain, three.js, interactive, animation
 * Viewport Width: 1440
 * Description: An interactive Three.js brain visual for the dedicated exploration page.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"full","className":"cogpace-brain-experience","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull cogpace-brain-experience">
	<div class="cogpace-brain-experience__copy">
		<p class="cogpace-brain-experience__eyebrow"><?php echo esc_html_x( 'Three.js experience', 'Interactive brain section eyebrow', 'cogpace' ); ?></p>
		<h2><?php echo esc_html_x( 'Your mind, in motion.', 'Interactive brain section heading', 'cogpace' ); ?></h2>
		<p class="cogpace-brain-experience__intro"><?php echo esc_html_x( 'Explore an interactive anatomical model of the human brain. Drag to rotate it and examine its form from every angle.', 'Interactive brain section introduction', 'cogpace' ); ?></p>
	</div>
	<div class="cogpace-brain-experience__stage" data-cogpace-brain>
		<canvas class="cogpace-brain-experience__canvas" aria-label="Interactive glowing three-dimensional brain. Drag to rotate it." role="img" tabindex="0"></canvas>
		<div class="cogpace-brain-experience__labels" data-brain-labels aria-hidden="true"></div>
		<p class="cogpace-brain-experience__hint" aria-hidden="true"><?php echo esc_html_x( 'Drag to rotate', 'Interactive brain interaction hint', 'cogpace' ); ?></p>
		<p class="cogpace-brain-experience__credit"><?php echo esc_html_x( 'Anatomical model:', 'Interactive brain model attribution label', 'cogpace' ); ?> <a href="https://3d.nih.gov/entries/3DPX-021160?version=1.01" rel="external noopener" target="_blank">NIH 3D, CC BY</a></p>
	</div>
</div>
<!-- /wp:group -->
