<?php
/**
 * Title: Feature grid
 * Slug: cogpace/feature-grid
 * Categories: cogpace
 * Keywords: features, grid, cards
 * Viewport Width: 1200
 * Description: A responsive two-item feature introduction.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"wide","className":"cogpace-home-paths cogpace-feature-grid","layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group alignwide cogpace-home-paths cogpace-feature-grid">
	<!-- wp:group {"className":"cogpace-home-path","layout":{"type":"constrained"}} -->
	<div class="wp-block-group cogpace-home-path">
		<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
		<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Understand', 'Blog pathway eyebrow', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"large"} -->
		<h2 class="wp-block-heading has-large-font-size"><?php echo esc_html_x( 'Blogs', 'Feature heading', 'cogpace' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"text-muted"} -->
		<p class="has-text-muted-color has-text-color"><?php echo esc_html_x( 'Read approachable explanations about cognition and everyday mental skills.', 'Feature description', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"cogpace-home-path__action"} -->
		<p class="cogpace-home-path__action"><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php echo esc_html_x( 'Explore articles →', 'Blog pathway action', 'cogpace' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"cogpace-home-path","layout":{"type":"constrained"}} -->
	<div class="wp-block-group cogpace-home-path">
		<!-- wp:paragraph {"className":"cogpace-eyebrow","textColor":"accent","fontSize":"small"} -->
		<p class="cogpace-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Practise', 'Practice pathway eyebrow', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2,"fontSize":"large"} -->
		<h2 class="wp-block-heading has-large-font-size"><?php echo esc_html_x( 'Cognitive activities', 'Feature heading', 'cogpace' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:paragraph {"textColor":"text-muted"} -->
		<p class="has-text-muted-color has-text-color"><?php echo esc_html_x( 'Try simple browser-based activities with clear instructions and accessible interactions.', 'Feature description', 'cogpace' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"className":"cogpace-home-path__action"} -->
		<p class="cogpace-home-path__action"><a href="<?php echo esc_url( home_url( '/practise/' ) ); ?>"><?php echo esc_html_x( 'Browse activities →', 'Practice pathway action', 'cogpace' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
