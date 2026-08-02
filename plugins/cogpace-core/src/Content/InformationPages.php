<?php
/**
 * Provisions the public information pages linked from the global footer.
 *
 * @package CogpaceCore
 */

namespace Cogpace\Core\Content;

use WP_Error;
use WP_Post;

/**
 * Creates versioned, WordPress-native information pages without overwriting
 * existing editorial content.
 */
final class InformationPages {
	private const SCHEMA_VERSION = '3';

	private const SCHEMA_OPTION = 'cogpace_information_pages_version';

	/**
	 * Creates missing pages once, then records the completed schema version.
	 *
	 * Existing non-empty pages retain their editorial content and are published.
	 *
	 * @return void
	 */
	public static function provision(): void {
		if ( self::SCHEMA_VERSION === get_option( self::SCHEMA_OPTION ) ) {
			return;
		}

		$privacy_page_id = 0;

		foreach ( self::get_pages() as $slug => $page ) {
			$existing = self::find_existing_page( $slug );
			$post     = array(
				'post_title'     => $page['title'],
				'post_name'      => $slug,
				'post_content'   => $page['content'],
				'post_status'    => 'publish',
				'post_type'      => 'page',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
			);

			if ( $existing instanceof WP_Post ) {
				$post['ID'] = $existing->ID;

				if ( '' !== trim( $existing->post_content ) ) {
					$post['post_content'] = self::upgrade_managed_content(
						$slug,
						$existing->post_content,
						(string) get_post_meta( $existing->ID, '_cogpace_information_page', true ),
						$page['content']
					);
				}
			}

			$page_id = wp_insert_post( wp_slash( $post ), true );

			if ( $page_id instanceof WP_Error ) {
				return;
			}

			update_post_meta( $page_id, '_cogpace_information_page', self::SCHEMA_VERSION );

			if ( 'privacy' === $slug ) {
				$privacy_page_id = $page_id;
			}
		}

		if ( 0 < $privacy_page_id ) {
			update_option( 'wp_page_for_privacy_policy', $privacy_page_id );
		}

		update_option( self::SCHEMA_OPTION, self::SCHEMA_VERSION );
	}

	/**
	 * Redirects the former Editorial Policy route to Content Standards.
	 *
	 * @return void
	 */
	public static function redirect_legacy_route(): void {
		global $wp;

		if (
			! is_404()
			|| ! isset( $wp->request )
			|| 'editorial-policy' !== trim( (string) $wp->request, '/' )
		) {
			return;
		}

		wp_safe_redirect( home_url( '/content-standards/' ), 301, 'Cogpace' );
		exit;
	}

	/**
	 * Finds the page for a managed route, including approved legacy slugs.
	 *
	 * The legacy page is migrated only when Cogpace previously provisioned it;
	 * an unrelated page using the old slug remains untouched.
	 *
	 * @param string $slug Current page slug.
	 * @return WP_Post|null
	 */
	private static function find_existing_page( string $slug ): ?WP_Post {
		$existing = get_page_by_path( $slug, OBJECT, 'page' );

		if ( $existing instanceof WP_Post ) {
			return $existing;
		}

		if ( 'content-standards' !== $slug ) {
			return null;
		}

		$legacy = get_page_by_path( 'editorial-policy', OBJECT, 'page' );

		if (
			! $legacy instanceof WP_Post
			|| '' === (string) get_post_meta( $legacy->ID, '_cogpace_information_page', true )
		) {
			return null;
		}

		return $legacy;
	}

	/**
	 * Applies narrowly scoped updates to pages previously provisioned by Cogpace.
	 *
	 * Unmanaged pages and later editorial revisions remain untouched.
	 *
	 * @param string $slug            Page slug.
	 * @param string $content         Existing page content.
	 * @param string $managed_version Cogpace content version stored on the page.
	 * @param string $managed_content New managed content for the current schema.
	 * @return string
	 */
	private static function upgrade_managed_content(
		string $slug,
		string $content,
		string $managed_version,
		string $managed_content
	): string {
		if (
			'content-standards' === $slug
			&& in_array( $managed_version, array( '1', '2' ), true )
		) {
			return $managed_content;
		}

		if ( 'cookies' !== $slug || '1' !== $managed_version ) {
			return $content;
		}

		$administration_section = <<<'HTML'
	<!-- wp:heading --><h2 class="wp-block-heading">WordPress administration</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>WordPress may use strictly necessary cookies when an authorized site editor signs in. These support authentication, security, and administrative preferences and are not used to track public visitors for advertising.</p><!-- /wp:paragraph -->
HTML;

		return str_replace( $administration_section, '', $content );
	}

	/**
	 * Returns the approved information-page definitions.
	 *
	 * @return array<string, array{title: string, content: string}>
	 */
	private static function get_pages(): array {
		return array(
			'about'             => array(
				'title'   => 'About Cogpace',
				'content' => <<<'HTML'
<!-- wp:group {"className":"cogpace-information-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-information-page">
	<!-- wp:paragraph --><p>Cogpace is an educational space for understanding cognition and trying focused, accessible mental activities.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">What you can do here</h2><!-- /wp:heading -->
	<!-- wp:list --><ul><li>Read evidence-aware explainers about the brain, learning, attention, and everyday habits.</li><li>Try short cognitive activities with clear instructions and session-only results.</li><li>Explore a visual model of the human brain and learn about major anatomical regions.</li></ul><!-- /wp:list -->
	<!-- wp:heading --><h2 class="wp-block-heading">How we work</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>We prefer plain language, visible uncertainty, accessible interactions, and sources that readers can inspect. The site owner checks every article before publication, and product experiences are designed to avoid collecting player results.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">What Cogpace is not</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Cogpace does not provide medical advice, diagnosis, treatment, or cognitive assessment. A score from an activity is not a measure of intelligence or cognitive health.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
				,
			),
			'content-standards' => array(
				'title'   => 'Content Standards',
				'content' => <<<'HTML'
<!-- wp:group {"className":"cogpace-information-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-information-page">
	<!-- wp:paragraph --><p>Cogpace is independently created and maintained. These standards explain how its educational content is researched, checked, and kept appropriately cautious.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Evidence and sources</h2><!-- /wp:heading -->
	<!-- wp:list --><ul><li>Material scientific claims link to authoritative sources near the claim they support.</li><li>Peer-reviewed research, scholarly reviews, and recognized public-health or professional guidance are preferred.</li><li>Established evidence is distinguished from mixed evidence, association, and practical inference.</li><li>Limitations, uncertainty, and meaningful conflicting findings are represented in plain language.</li></ul><!-- /wp:list -->
	<!-- wp:heading --><h2 class="wp-block-heading">Independent responsibility</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>The site owner checks every article for evidence, clarity, accessibility, and appropriate medical boundaries before publication. Automated tools may assist with research or drafting, but the site owner remains responsible for the final content.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Updates and corrections</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Published educational articles are checked at least every 12 months, and sooner when important evidence or a linked Cogpace experience changes. Substantive errors are corrected promptly, and outdated content may be revised or withdrawn.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Medical-claim boundary</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Cogpace content is general education, not medical advice or cognitive assessment. We do not diagnose readers, recommend treatment, promise prevention or cure, or present an activity score as evidence about an individual’s cognitive health.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
				,
			),
			'accessibility'     => array(
				'title'   => 'Accessibility',
				'content' => <<<'HTML'
<!-- wp:group {"className":"cogpace-information-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-information-page">
	<!-- wp:paragraph --><p>Cogpace aims to make its educational content and cognitive activities usable by as many people as practical, across input methods, screen sizes, and access needs.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Our approach</h2><!-- /wp:heading -->
	<!-- wp:list --><ul><li>Use semantic headings, descriptive links, readable text, and sufficient color contrast.</li><li>Support keyboard, pointer, and touch interaction where an activity requires input.</li><li>Provide visible focus states, clear status messages, and non-color cues.</li><li>Respect reduced-motion preferences and avoid making meaning depend on animation alone.</li><li>Keep content usable when zoomed and when layouts reflow on smaller screens.</li></ul><!-- /wp:list -->
	<!-- wp:heading --><h2 class="wp-block-heading">Conformance status</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>We use WCAG 2.2 Level AA as our design and review target. This is a target rather than a claim that every page has completed an independent conformance audit.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Ongoing work</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Accessibility is reviewed as content and activities change. Known issues are prioritized by their effect on completing a task, understanding information, and using the site without a mouse.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
				,
			),
			'privacy'           => array(
				'title'   => 'Privacy Notice',
				'content' => <<<'HTML'
<!-- wp:group {"className":"cogpace-information-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-information-page">
	<!-- wp:paragraph --><p>This notice explains the limited information Cogpace processes when you browse the site or use a cognitive activity.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Cognitive activities</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Activity answers, timings, and scores remain in your browser’s temporary memory for the current session. They are not sent to Cogpace, written to the server, placed in browser storage, or connected to an account. Reloading or leaving an activity clears its result.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Site operation</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>The hosting environment may process standard technical request data, such as an IP address, browser information, requested URL, and request time, to deliver the site, maintain security, and diagnose failures. Cogpace does not currently use advertising, behavioral profiling, or public-visitor analytics cookies.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Accounts and submissions</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Public visitors do not need an account to read articles or use activities. The site does not currently offer a public contact form, newsletter signup, or player profile.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Changes to this notice</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>This notice will be updated before introducing a feature that materially changes what information is collected, why it is used, or how long it is retained. Last updated: 1 August 2026.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
				,
			),
			'terms'             => array(
				'title'   => 'Terms & Disclaimer',
				'content' => <<<'HTML'
<!-- wp:group {"className":"cogpace-information-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-information-page">
	<!-- wp:paragraph --><p>By using Cogpace, you agree to use the site lawfully and understand the educational limits described below.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Educational use only</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Cogpace provides general educational information and recreational cognitive activities. It does not provide medical advice, diagnosis, treatment, professional care, or cognitive assessment. Seek an appropriately qualified professional for personal health concerns.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">No performance guarantees</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Activity scores can vary with familiarity, device, environment, fatigue, and other factors. They do not measure intelligence or cognitive health, and Cogpace does not guarantee improvements in health, learning, school, work, or daily functioning.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Responsible use</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Do not misuse the site, attempt to disrupt its operation, interfere with another visitor, or reproduce protected site materials in ways not permitted by applicable law.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Availability and changes</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Content and activities may be corrected, updated, withdrawn, or temporarily unavailable. External sources are provided for context; their availability and content are controlled by their respective publishers. Last updated: 1 August 2026.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
				,
			),
			'cookies'           => array(
				'title'   => 'Cookie Information',
				'content' => <<<'HTML'
<!-- wp:group {"className":"cogpace-information-page","layout":{"type":"constrained"}} -->
<div class="wp-block-group cogpace-information-page">
	<!-- wp:paragraph --><p>Cogpace does not currently use advertising, marketing, personalization, or public-visitor analytics cookies.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Public visitors</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Reading articles, exploring the brain model, and using cognitive activities does not require an account or optional cookie. Game answers and results are kept only in temporary page memory and are cleared when you reload or leave.</p><!-- /wp:paragraph -->
	<!-- wp:heading --><h2 class="wp-block-heading">Cookie controls</h2><!-- /wp:heading -->
	<!-- wp:paragraph --><p>Because the public site does not set optional cookie categories, there is currently no consent banner or separate cookie-settings control. This page and the privacy notice will be updated before optional cookies are introduced. Last updated: 1 August 2026.</p><!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
HTML
				,
			),
		);
	}
}
