<?php
/**
 * Title: Section Header
 * Slug: cogpace/section-header
 * Categories: text
 * Description: A concise heading and introduction for a page section.
 *
 * @package Cogpace
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|3"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
	<!-- wp:heading {"level":2} -->
	<h2 class="wp-block-heading"><?php echo esc_html_x( 'Section title', 'Section header pattern title', 'cogpace' ); ?></h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"fontSize":"medium"} -->
	<p class="has-medium-font-size"><?php echo esc_html_x( 'Add a concise introduction to this section.', 'Section header pattern description', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

