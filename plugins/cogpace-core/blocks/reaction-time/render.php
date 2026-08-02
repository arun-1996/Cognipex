<?php
/**
 * Reaction Time game block markup.
 *
 * @package CogpaceCore
 */

defined( 'ABSPATH' ) || exit;

$current_game_key = get_post_meta( get_the_ID(), 'cogpace_game_key', true );

if ( is_singular( 'cogpace_game' ) && 'reaction-time' !== $current_game_key ) {
	return;
}

$status_id  = wp_unique_id( 'cogpace-reaction-status-' );
$results_id = wp_unique_id( 'cogpace-reaction-results-' );
$strings    = array(
	'average'         => __( 'Average response: {average} milliseconds across {count} trials.', 'cogpace-core' ),
	'complete'        => __( 'Session complete. Review your results below or try again.', 'cogpace-core' ),
	'early'           => __( 'That was before the signal. This attempt does not count; wait for a new signal.', 'cogpace-core' ),
	'hidden_reset'    => __( 'The session was reset because this tab became hidden. Start again when ready.', 'cogpace-core' ),
	'preparing'       => __( 'Trial {trial} recorded. Preparing trial {next}.', 'cogpace-core' ),
	'recorded'        => __( 'Response recorded', 'cogpace-core' ),
	'respond_now'     => __( 'Respond now', 'cogpace-core' ),
	'signal'          => __( 'Signal shown. Activate the response button for trial {trial}.', 'cogpace-core' ),
	'start'           => __( 'Start five trials', 'cogpace-core' ),
	'too_soon'        => __( 'Too soon — wait', 'cogpace-core' ),
	'trial'           => __( 'Trial {trial}: {time} milliseconds', 'cogpace-core' ),
	'try_again'       => __( 'Try five more trials', 'cogpace-core' ),
	'wait'            => __( 'Wait for the signal', 'cogpace-core' ),
	'waiting'         => __( 'Trial {trial} of {total}. Wait for the signal.', 'cogpace-core' ),
	'response_button' => __( 'Response button', 'cogpace-core' ),
);
?>
<section
	<?php echo get_block_wrapper_attributes( array( 'class' => 'cogpace-reaction-time' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	data-cogpace-reaction-time
	data-trials="5"
	data-strings="<?php echo esc_attr( wp_json_encode( $strings ) ); ?>"
>
	<div class="cogpace-reaction-time__header">
		<p class="cogpace-reaction-time__eyebrow"><?php esc_html_e( 'Five-trial activity', 'cogpace-core' ); ?></p>
		<h2><?php esc_html_e( 'Reaction Time', 'cogpace-core' ); ?></h2>
		<p><?php esc_html_e( 'Wait for the signal, then activate the response button as soon as you can. Results are approximate and stay only in this page session.', 'cogpace-core' ); ?></p>
	</div>

	<div class="cogpace-reaction-time__panel" data-state="idle">
		<p id="<?php echo esc_attr( $status_id ); ?>" class="cogpace-reaction-time__status" aria-live="polite" aria-atomic="true">
			<?php esc_html_e( 'Ready for five trials. There is no response deadline.', 'cogpace-core' ); ?>
		</p>

		<button
			type="button"
			class="cogpace-reaction-time__target"
			data-reaction-target
			aria-describedby="<?php echo esc_attr( $status_id ); ?>"
			disabled
		>
			<?php esc_html_e( 'Response button', 'cogpace-core' ); ?>
		</button>

		<div class="cogpace-reaction-time__actions">
			<button type="button" class="cogpace-reaction-time__start" data-reaction-start>
				<?php esc_html_e( 'Start five trials', 'cogpace-core' ); ?>
			</button>
		</div>
	</div>

	<div id="<?php echo esc_attr( $results_id ); ?>" class="cogpace-reaction-time__results" data-reaction-results hidden>
		<h3><?php esc_html_e( 'Your session results', 'cogpace-core' ); ?></h3>
		<p data-reaction-summary></p>
		<ol data-reaction-list></ol>
		<p class="cogpace-reaction-time__note"><?php esc_html_e( 'Device, browser, input method, fatigue, and surroundings can affect these timings. This activity is educational practice, not a medical assessment.', 'cogpace-core' ); ?></p>
	</div>

	<noscript>
		<p><?php esc_html_e( 'This activity requires JavaScript. The surrounding educational content remains available without it.', 'cogpace-core' ); ?></p>
	</noscript>
</section>
