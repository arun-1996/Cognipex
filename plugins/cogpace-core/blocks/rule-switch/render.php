<?php
/**
 * Rule Switch game block markup.
 *
 * @package CogpaceCore
 */

defined( 'ABSPATH' ) || exit;

$current_game_key = get_post_meta( get_the_ID(), 'cogpace_game_key', true );

if ( is_singular( 'cogpace_game' ) && 'rule-switch' !== $current_game_key ) {
	return;
}

$prompt_id  = wp_unique_id( 'cogpace-rule-switch-prompt-' );
$status_id  = wp_unique_id( 'cogpace-rule-switch-status-' );
$results_id = wp_unique_id( 'cogpace-rule-switch-results-' );
$strings    = array(
	'choose'         => __( 'Choose the answer that follows the current rule.', 'cogpace-core' ),
	'complete'       => __( 'Session complete. You answered {score} of {total} correctly.', 'cogpace-core' ),
	'correct'        => __( 'Correct. {number} is {answer}.', 'cogpace-core' ),
	'finish'         => __( 'See results', 'cogpace-core' ),
	'high'           => __( 'High', 'cogpace-core' ),
	'incorrect'      => __( 'Not quite. Under this rule, {number} is {answer}.', 'cogpace-core' ),
	'low'            => __( 'Low', 'cogpace-core' ),
	'next'           => __( 'Next round', 'cogpace-core' ),
	'odd'            => __( 'Odd', 'cogpace-core' ),
	'even'           => __( 'Even', 'cogpace-core' ),
	'progress'       => __( 'Round {current} of {total}', 'cogpace-core' ),
	'rule_magnitude' => __( 'Low or high? Low is 1–4; high is 5–9.', 'cogpace-core' ),
	'rule_parity'    => __( 'Odd or even?', 'cogpace-core' ),
	'try_again'      => __( 'Play again', 'cogpace-core' ),
);
?>
<section
	<?php echo get_block_wrapper_attributes( array( 'class' => 'cogpace-rule-switch' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	data-cogpace-rule-switch
	data-rounds="12"
	data-strings="<?php echo esc_attr( wp_json_encode( $strings ) ); ?>"
>
	<div class="cogpace-rule-switch__header">
		<p class="cogpace-rule-switch__eyebrow"><?php esc_html_e( 'Twelve-round activity', 'cogpace-core' ); ?></p>
		<h2><?php esc_html_e( 'Rule Switch', 'cogpace-core' ); ?></h2>
		<p><?php esc_html_e( 'Classify each number using the rule shown for that round. The rule alternates, so read it before every answer.', 'cogpace-core' ); ?></p>
	</div>

	<div class="cogpace-rule-switch__panel" data-rule-switch-panel data-state="question">
		<p class="cogpace-rule-switch__progress" data-rule-switch-progress></p>
		<h3 id="<?php echo esc_attr( $prompt_id ); ?>" class="cogpace-rule-switch__rule" data-rule-switch-rule></h3>
		<p class="cogpace-rule-switch__number" data-rule-switch-number aria-labelledby="<?php echo esc_attr( $prompt_id ); ?>"></p>

		<div class="cogpace-rule-switch__answers" role="group" aria-labelledby="<?php echo esc_attr( $prompt_id ); ?>">
			<button type="button" data-rule-switch-answer disabled></button>
			<button type="button" data-rule-switch-answer disabled></button>
		</div>

		<p id="<?php echo esc_attr( $status_id ); ?>" class="cogpace-rule-switch__feedback" data-rule-switch-feedback aria-live="polite" aria-atomic="true"></p>

		<div class="cogpace-rule-switch__actions">
			<button type="button" data-rule-switch-next hidden><?php esc_html_e( 'Next round', 'cogpace-core' ); ?></button>
		</div>
	</div>

	<div id="<?php echo esc_attr( $results_id ); ?>" class="cogpace-rule-switch__results" data-rule-switch-results hidden>
		<h3><?php esc_html_e( 'Your result', 'cogpace-core' ); ?></h3>
		<p data-rule-switch-summary></p>
		<button type="button" data-rule-switch-restart><?php esc_html_e( 'Play again', 'cogpace-core' ); ?></button>
		<p class="cogpace-rule-switch__note"><?php esc_html_e( 'Your answers and score stay only in this page session and are not a cognitive assessment.', 'cogpace-core' ); ?></p>
	</div>

	<noscript>
		<p><?php esc_html_e( 'This activity requires JavaScript. The surrounding educational content remains available without it.', 'cogpace-core' ); ?></p>
	</noscript>
</section>
