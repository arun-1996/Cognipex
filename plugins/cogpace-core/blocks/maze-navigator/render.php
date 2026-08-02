<?php
/**
 * Maze Navigator game block markup.
 *
 * @package CogpaceCore
 */

defined( 'ABSPATH' ) || exit;

$current_game_key = get_post_meta( get_the_ID(), 'cogpace_game_key', true );

if ( is_singular( 'cogpace_game' ) && 'maze-navigator' !== $current_game_key ) {
	return;
}

$board_id   = wp_unique_id( 'cogpace-maze-board-' );
$status_id  = wp_unique_id( 'cogpace-maze-status-' );
$results_id = wp_unique_id( 'cogpace-maze-results-' );
$levels     = array(
	array(
		'S.....',
		'####..',
		'......',
		'..####',
		'......',
		'.....G',
	),
	array(
		'S#....',
		'.#.#..',
		'...#..',
		'##....',
		'...##.',
		'.....G',
	),
	array(
		'S..#..',
		'##.#..',
		'...#..',
		'.###..',
		'......',
		'####.G',
	),
	array(
		'S...#.',
		'###.#.',
		'.....#',
		'.###..',
		'...#..',
		'#....G',
	),
	array(
		'S#....',
		'.#.#.#',
		'...#..',
		'##...#',
		'...#..',
		'.#...G',
	),
);
$strings    = array(
	'blocked'      => __( 'Wall hit: minus one point. Try another route.', 'cogpace-core' ),
	'board_label'  => __( 'Maze. You are at row {row}, column {column}. The goal is at row {goalRow}, column {goalColumn}.', 'cogpace-core' ),
	'complete'     => __( 'You completed all {total} mazes in {moves} moves with {points} points.', 'cogpace-core' ),
	'complete_one' => __( 'You completed all {total} mazes in {moves} moves with {points} point.', 'cogpace-core' ),
	'finish'       => __( 'See results', 'cogpace-core' ),
	'level'        => __( 'Maze {current} of {total}', 'cogpace-core' ),
	'moved'        => __( 'Moved {direction}. Row {row}, column {column}.', 'cogpace-core' ),
	'moves'        => __( 'Moves: {moves}', 'cogpace-core' ),
	'next'         => __( 'Next maze', 'cogpace-core' ),
	'points'       => __( 'Points: {points}', 'cogpace-core' ),
	'reached'      => __( 'Goal reached in {moves} moves.', 'cogpace-core' ),
	'ready'        => __( 'Find the star. Use the arrow keys on the maze or the direction buttons.', 'cogpace-core' ),
	'try_again'    => __( 'Play again', 'cogpace-core' ),
);
?>
<section
	<?php echo get_block_wrapper_attributes( array( 'class' => 'cogpace-maze-navigator' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	data-cogpace-maze-navigator
	data-levels="<?php echo esc_attr( wp_json_encode( $levels ) ); ?>"
	data-strings="<?php echo esc_attr( wp_json_encode( $strings ) ); ?>"
>
	<div class="cogpace-maze-navigator__header">
		<p class="cogpace-maze-navigator__eyebrow"><?php esc_html_e( 'Five-maze activity', 'cogpace-core' ); ?></p>
		<h2><?php esc_html_e( 'Maze Navigator', 'cogpace-core' ); ?></h2>
		<p><?php esc_html_e( 'Guide the dot to the star. Navigate directly with arrow keys or use the on-screen direction pad.', 'cogpace-core' ); ?></p>
	</div>

	<div class="cogpace-maze-navigator__panel" data-maze-panel data-state="playing">
		<div class="cogpace-maze-navigator__meta">
			<p data-maze-progress></p>
			<p data-maze-moves></p>
			<p data-maze-points></p>
		</div>

		<div
			id="<?php echo esc_attr( $board_id ); ?>"
			class="cogpace-maze-navigator__board"
			data-maze-board
			role="img"
			tabindex="0"
		></div>

		<div class="cogpace-maze-navigator__controls" aria-label="<?php esc_attr_e( 'Maze movement controls', 'cogpace-core' ); ?>">
			<button type="button" data-maze-direction="up" aria-label="<?php esc_attr_e( 'Move up', 'cogpace-core' ); ?>">↑</button>
			<button type="button" data-maze-direction="left" aria-label="<?php esc_attr_e( 'Move left', 'cogpace-core' ); ?>">←</button>
			<button type="button" data-maze-direction="down" aria-label="<?php esc_attr_e( 'Move down', 'cogpace-core' ); ?>">↓</button>
			<button type="button" data-maze-direction="right" aria-label="<?php esc_attr_e( 'Move right', 'cogpace-core' ); ?>">→</button>
		</div>

		<p id="<?php echo esc_attr( $status_id ); ?>" class="cogpace-maze-navigator__status" data-maze-status aria-live="polite" aria-atomic="true"></p>

		<div class="cogpace-maze-navigator__actions">
			<button type="button" data-maze-next hidden><?php esc_html_e( 'Next maze', 'cogpace-core' ); ?></button>
		</div>
	</div>

	<div id="<?php echo esc_attr( $results_id ); ?>" class="cogpace-maze-navigator__results" data-maze-results hidden>
		<h3><?php esc_html_e( 'Route complete', 'cogpace-core' ); ?></h3>
		<p data-maze-summary></p>
		<button type="button" data-maze-restart><?php esc_html_e( 'Play again', 'cogpace-core' ); ?></button>
		<p class="cogpace-maze-navigator__note"><?php esc_html_e( 'Your route, move count, and points stay only in this page session and are not a cognitive assessment.', 'cogpace-core' ); ?></p>
	</div>

	<noscript>
		<p><?php esc_html_e( 'This activity requires JavaScript. The surrounding educational content remains available without it.', 'cogpace-core' ); ?></p>
	</noscript>
</section>
