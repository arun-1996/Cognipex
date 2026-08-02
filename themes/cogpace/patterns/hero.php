<?php
/**
 * Title: Product hero
 * Slug: cogpace/hero
 * Categories: cogpace
 * Keywords: hero, introduction, call to action
 * Viewport Width: 1200
 * Description: A focused introductory hero with one primary action.
 *
 * @package Cogpace
 */

?>
<!-- wp:group {"align":"full","className":"cogpace-home-hero","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull cogpace-home-hero">
	<!-- wp:video {"autoplay":true,"loop":true,"muted":true,"playsInline":true,"className":"cogpace-home-hero__video"} -->
	<figure class="wp-block-video cogpace-home-hero__video"><video autoplay loop muted playsinline preload="metadata" aria-hidden="true" tabindex="-1"><source src="<?php echo esc_url( get_theme_file_uri( 'assets/videos/cogpace-hero.mp4' ) ); ?>" type="video/mp4"></video></figure>
	<!-- /wp:video -->

	<!-- wp:paragraph {"className":"cogpace-home-eyebrow","textColor":"accent","fontSize":"small"} -->
	<p class="cogpace-home-eyebrow has-accent-color has-text-color has-small-font-size"><?php echo esc_html_x( 'Understand. Practise. Grow.', 'Hero eyebrow', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1,"fontSize":"xx-large"} -->
	<h1 class="wp-block-heading has-xx-large-font-size"><?php echo esc_html_x( 'Elevate your mind.', 'Hero heading', 'cogpace' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"cogpace-home-intro","textColor":"text-muted","fontSize":"medium"} -->
	<p class="cogpace-home-intro has-text-muted-color has-text-color has-medium-font-size"><?php echo esc_html_x( 'Read practical ideas about cognition, then try accessible activities designed for thoughtful practice.', 'Hero introduction', 'cogpace' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:buttons -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/practise/"><?php echo esc_html_x( 'Explore cognitive games', 'Hero call to action', 'cogpace' ); ?></a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
