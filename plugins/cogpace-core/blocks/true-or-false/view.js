( () => {
	'use strict';

	const initialize = ( root ) => {
		const panel = root.querySelector( '[data-true-false-panel]' );
		const progress = root.querySelector( '[data-true-false-progress]' );
		const statement = root.querySelector( '[data-true-false-statement]' );
		const answerButtons = Array.from(
			root.querySelectorAll( '[data-true-false-answer]' )
		);
		const feedback = root.querySelector( '[data-true-false-feedback]' );
		const nextButton = root.querySelector( '[data-true-false-next]' );
		const results = root.querySelector( '[data-true-false-results]' );
		const summary = root.querySelector( '[data-true-false-summary]' );
		const restartButton = root.querySelector( '[data-true-false-restart]' );

		if (
			! panel ||
			! progress ||
			! statement ||
			answerButtons.length !== 2 ||
			! feedback ||
			! nextButton ||
			! results ||
			! summary ||
			! restartButton
		) {
			return;
		}

		let questionBank;
		let strings;

		try {
			questionBank = JSON.parse( root.dataset.questions || '[]' );
			strings = JSON.parse( root.dataset.strings || '{}' );
		} catch {
			return;
		}

		if ( ! Array.isArray( questionBank ) || questionBank.length === 0 ) {
			return;
		}

		let questions = [];
		let currentIndex = 0;
		let score = 0;
		let answered = false;

		const format = ( template, values = {} ) =>
			Object.entries( values ).reduce(
				( message, [ key, value ] ) =>
					message.replaceAll( `{${ key }}`, String( value ) ),
				template || ''
			);

		const shuffle = ( items ) => {
			const shuffled = [ ...items ];

			for ( let index = shuffled.length - 1; index > 0; index-- ) {
				const randomIndex = Math.floor( Math.random() * ( index + 1 ) );
				[ shuffled[ index ], shuffled[ randomIndex ] ] = [
					shuffled[ randomIndex ],
					shuffled[ index ],
				];
			}

			return shuffled;
		};

		const renderQuestion = () => {
			const question = questions[ currentIndex ];
			answered = false;
			panel.dataset.state = 'question';
			progress.textContent = format( strings.progress, {
				current: currentIndex + 1,
				total: questions.length,
			} );
			statement.textContent = question.statement;
			feedback.textContent = strings.choose;
			nextButton.hidden = true;
			answerButtons.forEach( ( button ) => {
				button.disabled = false;
			} );
		};

		const renderResults = () => {
			panel.hidden = true;
			results.hidden = false;
			summary.textContent = format( strings.complete, {
				score,
				total: questions.length,
			} );
			restartButton.textContent = strings.try_again;
			restartButton.focus();
		};

		const answer = ( choice ) => {
			if ( answered ) {
				return;
			}

			answered = true;
			const question = questions[ currentIndex ];
			const isCorrect = choice === Boolean( question.answer );

			if ( isCorrect ) {
				score++;
			}

			panel.dataset.state = isCorrect ? 'correct' : 'incorrect';
			feedback.textContent = format(
				isCorrect ? strings.correct : strings.incorrect,
				{ explanation: question.explanation }
			);
			answerButtons.forEach( ( button ) => {
				button.disabled = true;
			} );
			nextButton.textContent =
				currentIndex + 1 === questions.length
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

			if ( currentIndex >= questions.length ) {
				renderResults();
				return;
			}

			renderQuestion();
			answerButtons[ 0 ].focus();
		};

		const start = () => {
			questions = shuffle( questionBank );
			currentIndex = 0;
			score = 0;
			panel.hidden = false;
			results.hidden = true;
			renderQuestion();
		};

		answerButtons.forEach( ( button ) => {
			button.addEventListener( 'click', () => {
				answer( button.dataset.trueFalseAnswer === 'true' );
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
		.querySelectorAll( '[data-cogpace-true-false]' )
		.forEach( initialize );
} )();
