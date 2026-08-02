( () => {
	'use strict';

	const initialize = ( root ) => {
		const panel = root.querySelector( '[data-rule-switch-panel]' );
		const progress = root.querySelector( '[data-rule-switch-progress]' );
		const rule = root.querySelector( '[data-rule-switch-rule]' );
		const number = root.querySelector( '[data-rule-switch-number]' );
		const answerButtons = Array.from(
			root.querySelectorAll( '[data-rule-switch-answer]' )
		);
		const feedback = root.querySelector( '[data-rule-switch-feedback]' );
		const nextButton = root.querySelector( '[data-rule-switch-next]' );
		const results = root.querySelector( '[data-rule-switch-results]' );
		const summary = root.querySelector( '[data-rule-switch-summary]' );
		const restartButton = root.querySelector(
			'[data-rule-switch-restart]'
		);

		if (
			! panel ||
			! progress ||
			! rule ||
			! number ||
			answerButtons.length !== 2 ||
			! feedback ||
			! nextButton ||
			! results ||
			! summary ||
			! restartButton
		) {
			return;
		}

		let strings;

		try {
			strings = JSON.parse( root.dataset.strings || '{}' );
		} catch {
			return;
		}

		const totalRounds = Number.parseInt( root.dataset.rounds || '12', 10 );

		if ( ! Number.isInteger( totalRounds ) || totalRounds < 1 ) {
			return;
		}

		let rounds = [];
		let currentIndex = 0;
		let score = 0;
		let answered = false;

		const format = ( template, values = {} ) =>
			Object.entries( values ).reduce(
				( message, [ key, value ] ) =>
					message.replaceAll( `{${ key }}`, String( value ) ),
				template || ''
			);

		const createRounds = () => {
			const firstRule = Math.random() < 0.5 ? 'parity' : 'magnitude';
			let previousNumber = 0;

			return Array.from( { length: totalRounds }, ( unused, index ) => {
				let value;

				do {
					value = Math.floor( Math.random() * 9 ) + 1;
				} while ( value === previousNumber );

				previousNumber = value;
				let currentRule = firstRule;
				let answer;

				if ( index % 2 !== 0 ) {
					currentRule =
						firstRule === 'parity' ? 'magnitude' : 'parity';
				}

				if ( currentRule === 'parity' ) {
					answer = value % 2 === 0 ? 'even' : 'odd';
				} else {
					answer = value <= 4 ? 'low' : 'high';
				}

				return { answer, number: value, rule: currentRule };
			} );
		};

		const renderRound = () => {
			const currentRound = rounds[ currentIndex ];
			const answers =
				currentRound.rule === 'parity'
					? [ 'odd', 'even' ]
					: [ 'low', 'high' ];

			answered = false;
			panel.dataset.state = 'question';
			progress.textContent = format( strings.progress, {
				current: currentIndex + 1,
				total: rounds.length,
			} );
			rule.textContent =
				currentRound.rule === 'parity'
					? strings.rule_parity
					: strings.rule_magnitude;
			number.textContent = String( currentRound.number );
			feedback.textContent = strings.choose;
			nextButton.hidden = true;

			answerButtons.forEach( ( button, index ) => {
				button.dataset.ruleSwitchAnswer = answers[ index ];
				button.textContent = strings[ answers[ index ] ];
				button.disabled = false;
			} );
		};

		const renderResults = () => {
			panel.hidden = true;
			results.hidden = false;
			summary.textContent = format( strings.complete, {
				score,
				total: rounds.length,
			} );
			restartButton.textContent = strings.try_again;
			restartButton.focus();
		};

		const answer = ( choice ) => {
			if ( answered ) {
				return;
			}

			answered = true;
			const currentRound = rounds[ currentIndex ];
			const isCorrect = choice === currentRound.answer;

			if ( isCorrect ) {
				score++;
			}

			panel.dataset.state = isCorrect ? 'correct' : 'incorrect';
			feedback.textContent = format(
				isCorrect ? strings.correct : strings.incorrect,
				{
					answer: strings[ currentRound.answer ].toLowerCase(),
					number: currentRound.number,
				}
			);
			answerButtons.forEach( ( button ) => {
				button.disabled = true;
			} );
			nextButton.textContent =
				currentIndex + 1 === rounds.length
					? strings.finish
					: strings.next;
			nextButton.hidden = false;
			nextButton.focus();
		};

		const next = () => {
			if ( ! answered ) {
				return;
			}

			currentIndex++;

			if ( currentIndex >= rounds.length ) {
				renderResults();
				return;
			}

			renderRound();
			answerButtons[ 0 ].focus();
		};

		const start = () => {
			rounds = createRounds();
			currentIndex = 0;
			score = 0;
			panel.hidden = false;
			results.hidden = true;
			renderRound();
		};

		answerButtons.forEach( ( button ) => {
			button.addEventListener( 'click', () => {
				answer( button.dataset.ruleSwitchAnswer );
			} );
		} );
		nextButton.addEventListener( 'click', next );
		restartButton.addEventListener( 'click', () => {
			start();
			answerButtons[ 0 ].focus();
		} );

		start();
	};

	document
		.querySelectorAll( '[data-cogpace-rule-switch]' )
		.forEach( initialize );
} )();
