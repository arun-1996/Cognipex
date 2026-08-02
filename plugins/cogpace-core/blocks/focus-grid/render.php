<?php
/**
 * Focus Grid game block markup.
 *
 * @package CogpaceCore
 */

defined( 'ABSPATH' ) || exit;

$current_game_key = get_post_meta( get_the_ID(), 'cogpace_game_key', true );

if ( is_singular( 'cogpace_game' ) && 'focus-grid' !== $current_game_key ) {
	return;
}

$prompt_id  = wp_unique_id( 'cogpace-focus-grid-prompt-' );
$status_id  = wp_unique_id( 'cogpace-focus-grid-status-' );
$results_id = wp_unique_id( 'cogpace-focus-grid-results-' );
$strings    = array(
	'complete'       => __( 'You completed all {total} grids with {mistakes} mistakes.', 'cogpace-core' ),
	'complete_one'   => __( 'You completed all {total} grids with {mistakes} mistake.', 'cogpace-core' ),
	'correct'        => __( 'Found {number}. Now find {next}.', 'cogpace-core' ),
	'finish'         => __( 'See results', 'cogpace-core' ),
	'found_label'    => __( 'Number {number}, found', 'cogpace-core' ),
	'grid_label'     => __( 'Number grid. Find {target}.', 'cogpace-core' ),
	'level'          => __( 'Grid {current} of {total}', 'cogpace-core' ),
	'mistakes'       => __( 'Mistakes: {mistakes}', 'cogpace-core' ),
	'next'           => __( 'Next grid', 'cogpace-core' ),
	'number_label'   => __( 'Number {number}', 'cogpace-core' ),
	'prompt'         => __( 'Find {target}', 'cogpace-core' ),
	'ready'          => __( 'Start with 1, then continue in ascending order.', 'cogpace-core' ),
	'round_complete' => __( 'Grid complete with {mistakes} mistakes.', 'cogpace-core' ),
	'try_again'      => __( 'Play again', 'cogpace-core' ),
	'wrong'          => __( 'Not yet. Find {target} next.', 'cogpace-core' ),
);
?>
<section
	<?php echo get_block_wrapper_attributes( array( 'class' => 'cogpace-focus-grid' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	data-cogpace-focus-grid
	data-levels="9,16,25"
	data-strings="<?php echo esc_attr( wp_json_encode( $strings ) ); ?>"
>
	<div class="cogpace-focus-grid__header">
		<p class="cogpace-focus-grid__eyebrow"><?php esc_html_e( 'Three-grid activity', 'cogpace-core' ); ?></p>
		<h2><?php esc_html_e( 'Focus Grid', 'cogpace-core' ); ?></h2>
		<p><?php esc_html_e( 'Scan each shuffled grid and select every number in ascending order. The grids grow as you progress.', 'cogpace-core' ); ?></p>
	</div>

	<div class="cogpace-focus-grid__panel" data-focus-grid-panel data-state="playing">
		<div class="cogpace-focus-grid__meta">
			<p data-focus-grid-progress></p>
			<p data-focus-grid-mistakes></p>
		</div>

		<h3 id="<?php echo esc_attr( $prompt_id ); ?>" class="cogpace-focus-grid__prompt" data-focus-grid-prompt></h3>

		<div
			class="cogpace-focus-grid__board"
			data-focus-grid-board
			role="group"
			aria-labelledby="<?php echo esc_attr( $prompt_id ); ?>"
			tabindex="-1"
		></div>

		<p id="<?php echo esc_attr( $status_id ); ?>" class="cogpace-focus-grid__status" data-focus-grid-status aria-live="polite" aria-atomic="true"></p>

		<div class="cogpace-focus-grid__actions">
			<button type="button" data-focus-grid-next hidden><?php esc_html_e( 'Next grid', 'cogpace-core' ); ?></button>
		</div>
	</div>

	<div id="<?php echo esc_attr( $results_id ); ?>" class="cogpace-focus-grid__results" data-focus-grid-results hidden>
		<h3><?php esc_html_e( 'Session complete', 'cogpace-core' ); ?></h3>
		<p data-focus-grid-summary></p>
		<button type="button" data-focus-grid-restart><?php esc_html_e( 'Play again', 'cogpace-core' ); ?></button>
		<p class="cogpace-focus-grid__note"><?php esc_html_e( 'Your selections and mistake count stay only in this page session. This activity is practice, not an assessment or a promise of improved attention.', 'cogpace-core' ); ?></p>
	</div>

	<noscript>
		<p><?php esc_html_e( 'This activity requires JavaScript. The surrounding educational content remains available without it.', 'cogpace-core' ); ?></p>
	</noscript>
</section>
