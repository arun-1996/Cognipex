<?php
/**
 * True or False game block markup.
 *
 * @package CogpaceCore
 */

defined( 'ABSPATH' ) || exit;

$current_game_key = get_post_meta( get_the_ID(), 'cogpace_game_key', true );

if ( is_singular( 'cogpace_game' ) && 'true-or-false' !== $current_game_key ) {
	return;
}

$question_id = wp_unique_id( 'cogpace-true-false-question-' );
$status_id   = wp_unique_id( 'cogpace-true-false-status-' );
$results_id  = wp_unique_id( 'cogpace-true-false-results-' );
$questions   = array(
	array(
		'statement'   => __( 'Seven multiplied by eight equals 56.', 'cogpace-core' ),
		'answer'      => true,
		'explanation' => __( 'Seven groups of eight total 56.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'Every square is also a rectangle.', 'cogpace-core' ),
		'answer'      => true,
		'explanation' => __( 'A square has four right angles, so it meets the definition of a rectangle.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'The Pacific Ocean is smaller than the Atlantic Ocean.', 'cogpace-core' ),
		'answer'      => false,
		'explanation' => __( 'The Pacific Ocean is larger than the Atlantic Ocean.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'A palindrome reads the same forward and backward.', 'cogpace-core' ),
		'answer'      => true,
		'explanation' => __( 'Words such as level and civic are palindromes.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'Two is the only even prime number.', 'cogpace-core' ),
		'answer'      => true,
		'explanation' => __( 'Every other even number is divisible by two and therefore is not prime.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'Sound travels faster than light.', 'cogpace-core' ),
		'answer'      => false,
		'explanation' => __( 'Light travels much faster than sound.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'A whale is a fish.', 'cogpace-core' ),
		'answer'      => false,
		'explanation' => __( 'Whales are mammals that breathe air and nurse their young.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'In ordinary plane geometry, a triangle can have two right angles.', 'cogpace-core' ),
		'answer'      => false,
		'explanation' => __( 'In ordinary plane geometry, two right angles already total 180 degrees and leave no angle for a triangle.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'The word rhythm contains a standard vowel: A, E, I, O, or U.', 'cogpace-core' ),
		'answer'      => false,
		'explanation' => __( 'Rhythm contains none of the five standard vowel letters.', 'cogpace-core' ),
	),
	array(
		'statement'   => __( 'In the Gregorian calendar, every year divisible by four is a leap year without exception.', 'cogpace-core' ),
		'answer'      => false,
		'explanation' => __( 'Century years must also be divisible by 400, so 1900 was not a leap year but 2000 was.', 'cogpace-core' ),
	),
);
$strings     = array(
	'choose'    => __( 'Choose True or False.', 'cogpace-core' ),
	'complete'  => __( 'Round complete. You answered {score} of {total} correctly.', 'cogpace-core' ),
	'correct'   => __( 'Correct. {explanation}', 'cogpace-core' ),
	'finish'    => __( 'See results', 'cogpace-core' ),
	'incorrect' => __( 'Not quite. {explanation}', 'cogpace-core' ),
	'next'      => __( 'Next question', 'cogpace-core' ),
	'progress'  => __( 'Question {current} of {total}', 'cogpace-core' ),
	'try_again' => __( 'Play again', 'cogpace-core' ),
);
?>
<section
	<?php echo get_block_wrapper_attributes( array( 'class' => 'cogpace-true-false' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	data-cogpace-true-false
	data-questions="<?php echo esc_attr( wp_json_encode( $questions ) ); ?>"
	data-strings="<?php echo esc_attr( wp_json_encode( $strings ) ); ?>"
>
	<div class="cogpace-true-false__header">
		<p class="cogpace-true-false__eyebrow"><?php esc_html_e( 'Ten-question activity', 'cogpace-core' ); ?></p>
		<h2><?php esc_html_e( 'True or False', 'cogpace-core' ); ?></h2>
		<p><?php esc_html_e( 'Judge each statement, learn from the explanation, and see your score at the end. Questions appear in a new order each round.', 'cogpace-core' ); ?></p>
	</div>

	<div class="cogpace-true-false__panel" data-true-false-panel data-state="question">
		<p class="cogpace-true-false__progress" data-true-false-progress></p>
		<h3 id="<?php echo esc_attr( $question_id ); ?>" class="cogpace-true-false__statement" data-true-false-statement>
			<?php esc_html_e( 'Preparing the first statement…', 'cogpace-core' ); ?>
		</h3>

		<div class="cogpace-true-false__answers" role="group" aria-labelledby="<?php echo esc_attr( $question_id ); ?>">
			<button type="button" data-true-false-answer="true" disabled>
				<?php esc_html_e( 'True', 'cogpace-core' ); ?>
			</button>
			<button type="button" data-true-false-answer="false" disabled>
				<?php esc_html_e( 'False', 'cogpace-core' ); ?>
			</button>
		</div>

		<p id="<?php echo esc_attr( $status_id ); ?>" class="cogpace-true-false__feedback" data-true-false-feedback aria-live="polite" aria-atomic="true"></p>

		<div class="cogpace-true-false__actions">
			<button type="button" data-true-false-next hidden>
				<?php esc_html_e( 'Next question', 'cogpace-core' ); ?>
			</button>
		</div>
	</div>

	<div id="<?php echo esc_attr( $results_id ); ?>" class="cogpace-true-false__results" data-true-false-results hidden>
		<h3 data-true-false-result-heading><?php esc_html_e( 'Your result', 'cogpace-core' ); ?></h3>
		<p data-true-false-summary></p>
		<button type="button" data-true-false-restart><?php esc_html_e( 'Play again', 'cogpace-core' ); ?></button>
		<p class="cogpace-true-false__note"><?php esc_html_e( 'Your answers and score stay only in this page session and are not a cognitive assessment.', 'cogpace-core' ); ?></p>
	</div>

	<noscript>
		<p><?php esc_html_e( 'This activity requires JavaScript. The surrounding educational content remains available without it.', 'cogpace-core' ); ?></p>
	</noscript>
</section>
