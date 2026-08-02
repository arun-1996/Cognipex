<?php
/**
 * Title: Research reference card
 * Slug: cogpace/research-card
 * Categories: cogpace
 * Keywords: research, reference, evidence
 * Description: A compact reference summary for use inside reviewed articles.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"className":"cogpace-card cogpace-research-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-card cogpace-research-card">
	<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
	<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Reference', 'Research card eyebrow', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":3,"fontSize":"large"} -->
	<h3 class="wp-block-heading has-large-font-size"><?php echo esc_html_x( 'Add the reviewed source title', 'Research card title placeholder', 'cogpace' ); ?></h3>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"textColor":"text-muted"} -->
	<p class="has-text-muted-color has-text-color"><?php echo esc_html_x( 'Summarize what the source supports and note important limitations.', 'Research card summary placeholder', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
