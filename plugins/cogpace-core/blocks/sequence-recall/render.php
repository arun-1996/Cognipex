<?php
/**
 * Sequence Recall game block markup.
 *
 * @package CogpaceCore
 */

defined( 'ABSPATH' ) || exit;

$current_game_key = get_post_meta( get_the_ID(), 'cogpace_game_key', true );

if ( is_singular( 'cogpace_game' ) && 'sequence-recall' !== $current_game_key ) {
	return;
}

$status_id = wp_unique_id( 'cogpace-sequence-status-' );
$tiles     = array(
	array(
		'label'  => __( 'Circle', 'cogpace-core' ),
		'symbol' => '●',
		'value'  => 0,
	),
	array(
		'label'  => __( 'Triangle', 'cogpace-core' ),
		'symbol' => '▲',
		'value'  => 1,
	),
	array(
		'label'  => __( 'Square', 'cogpace-core' ),
		'symbol' => '■',
		'value'  => 2,
	),
	array(
		'label'  => __( 'Diamond', 'cogpace-core' ),
		'symbol' => '◆',
		'value'  => 3,
	),
);
$strings   = array(
	'choose'         => __( 'Your turn. Repeat all {total} items in order.', 'cogpace-core' ),
	'complete'       => __( 'You completed all {rounds} rounds. Longest sequence: {length} items.', 'cogpace-core' ),
	'hidden'         => __( 'Sequence playback paused because this tab became hidden. Replay the sequence when ready.', 'cogpace-core' ),
	'input_progress' => __( 'Good. {current} of {total} items entered.', 'cogpace-core' ),
	'mistake'        => __( 'Round ended. You completed {rounds} of {total} rounds. Longest sequence: {length} items.', 'cogpace-core' ),
	'next'           => __( 'Start round {round}', 'cogpace-core' ),
	'replay'         => __( 'Replay sequence', 'cogpace-core' ),
	'reveal'         => __( 'The sequence was: {sequence}.', 'cogpace-core' ),
	'round_complete' => __( 'Correct. Round {round} is complete.', 'cogpace-core' ),
	'start'          => __( 'Start memory game', 'cogpace-core' ),
	'try_again'      => __( 'Play again', 'cogpace-core' ),
	'watch'          => __( 'Watch item {current} of {total}: {label}.', 'cogpace-core' ),
	'watch_intro'    => __( 'Watch the sequence for round {round}.', 'cogpace-core' ),
);
?>
<section
	<?php echo get_block_wrapper_attributes( array( 'class' => 'cogpace-sequence-recall' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	data-cogpace-sequence-recall
	data-rounds="5"
	data-start-length="3"
	data-strings="<?php echo esc_attr( wp_json_encode( $strings ) ); ?>"
>
	<div class="cogpace-sequence-recall__header">
		<p class="cogpace-sequence-recall__eyebrow"><?php esc_html_e( 'Five-round activity', 'cogpace-core' ); ?></p>
		<h2><?php esc_html_e( 'Sequence Recall', 'cogpace-core' ); ?></h2>
		<p><?php esc_html_e( 'Watch the numbered shapes, then repeat them in the same order. Each successful round adds one item.', 'cogpace-core' ); ?></p>
	</div>

	<div class="cogpace-sequence-recall__panel" data-sequence-panel data-state="idle">
		<p id="<?php echo esc_attr( $status_id ); ?>" class="cogpace-sequence-recall__status" data-sequence-status aria-live="polite" aria-atomic="true">
			<?php esc_html_e( 'Ready for five rounds, starting with three items. There is no response deadline.', 'cogpace-core' ); ?>
		</p>

		<div class="cogpace-sequence-recall__board" role="group" aria-label="<?php esc_attr_e( 'Sequence choices', 'cogpace-core' ); ?>">
			<?php foreach ( $tiles as $tile ) : ?>
				<button
					type="button"
					class="cogpace-sequence-recall__tile"
					data-sequence-tile="<?php echo esc_attr( (string) $tile['value'] ); ?>"
					data-label="<?php echo esc_attr( $tile['label'] ); ?>"
					aria-keyshortcuts="<?php echo esc_attr( (string) ( $tile['value'] + 1 ) ); ?>"
					disabled
				>
					<span class="cogpace-sequence-recall__symbol" aria-hidden="true"><?php echo esc_html( $tile['symbol'] ); ?></span>
					<span><?php echo esc_html( (string) ( $tile['value'] + 1 ) . ' — ' . $tile['label'] ); ?></span>
				</button>
			<?php endforeach; ?>
		</div>

		<div class="cogpace-sequence-recall__actions">
			<button type="button" data-sequence-start><?php esc_html_e( 'Start memory game', 'cogpace-core' ); ?></button>
			<button type="button" data-sequence-replay hidden disabled><?php esc_html_e( 'Replay sequence', 'cogpace-core' ); ?></button>
			<button type="button" data-sequence-next hidden><?php esc_html_e( 'Next round', 'cogpace-core' ); ?></button>
		</div>
	</div>

	<div class="cogpace-sequence-recall__results" data-sequence-results hidden>
		<h3><?php esc_html_e( 'Your session result', 'cogpace-core' ); ?></h3>
		<p data-sequence-summary></p>
		<p data-sequence-reveal hidden></p>
		<button type="button" data-sequence-restart><?php esc_html_e( 'Play again', 'cogpace-core' ); ?></button>
		<p class="cogpace-sequence-recall__note"><?php esc_html_e( 'Your sequence and result stay only in this page session. This activity is educational practice, not a cognitive assessment.', 'cogpace-core' ); ?></p>
	</div>

	<noscript>
		<p><?php esc_html_e( 'This activity requires JavaScript. The surrounding educational content remains available without it.', 'cogpace-core' ); ?></p>
	</noscript>
</section>
