<?php
/**
 * Title: Article Card
 * Slug: cogpace/article-card
 * Categories: query
 * Description: A compact article card for use inside a Query Loop post template.
 * Block Types: core/post-template
 *
 * @package Cogpace
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"className":"cogpace-card cogpace-article-card","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-card cogpace-article-card">
	<!-- wp:post-featured-image {"isLink":true} /-->

	<!-- wp:group {"className":"cogpace-article-card__content","layout":{"type":"constrained"}} -->
	<div class="wp-block-group cogpace-article-card__content">
		<!-- wp:post-date {"style":{"color":{"text":"var:preset|color|text-muted"}},"fontSize":"small"} /-->

		<!-- wp:post-title {"isLink":true,"level":2} /-->

		<!-- wp:post-excerpt /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
