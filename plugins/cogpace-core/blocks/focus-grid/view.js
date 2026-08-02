( () => {
	'use strict';

	const initialize = ( root ) => {
		const panel = root.querySelector( '[data-focus-grid-panel]' );
		const progress = root.querySelector( '[data-focus-grid-progress]' );
		const mistakeCounter = root.querySelector(
			'[data-focus-grid-mistakes]'
		);
		const prompt = root.querySelector( '[data-focus-grid-prompt]' );
		const board = root.querySelector( '[data-focus-grid-board]' );
		const status = root.querySelector( '[data-focus-grid-status]' );
		const nextButton = root.querySelector( '[data-focus-grid-next]' );
		const results = root.querySelector( '[data-focus-grid-results]' );
		const summary = root.querySelector( '[data-focus-grid-summary]' );
		const restartButton = root.querySelector( '[data-focus-grid-restart]' );

		if (
			! panel ||
			! progress ||
			! mistakeCounter ||
			! prompt ||
			! board ||
			! status ||
			! nextButton ||
			! results ||
			! summary ||
			! restartButton
		) {
			return;
		}

		let levels;
		let strings;

		try {
			levels = ( root.dataset.levels || '' )
				.split( ',' )
				.map( ( value ) => Number.parseInt( value, 10 ) );
			strings = JSON.parse( root.dataset.strings || '{}' );
		} catch {
			return;
		}

		if (
			levels.length === 0 ||
			levels.some(
				( value ) =>
					! Number.isInteger( value ) || Math.sqrt( value ) % 1
			)
		) {
			return;
		}

		let levelIndex = 0;
		let target = 1;
		let levelMistakes = 0;
		let totalMistakes = 0;
		let levelComplete = false;

		const format = ( template, values = {} ) =>
			Object.entries( values ).reduce(
				( message, [ key, value ] ) =>
					message.replaceAll( `{${ key }}`, String( value ) ),
				template || ''
			);

		const shuffle = ( values ) => {
			const shuffled = [ ...values ];

			for ( let index = shuffled.length - 1; index > 0; index-- ) {
				const randomIndex = Math.floor( Math.random() * ( index + 1 ) );
				[ shuffled[ index ], shuffled[ randomIndex ] ] = [
					shuffled[ randomIndex ],
					shuffled[ index ],
				];
			}

			return shuffled;
		};

		const updatePrompt = () => {
			prompt.textContent = format( strings.prompt, { target } );
			board.setAttribute(
				'aria-label',
				format( strings.grid_label, { target } )
			);
		};

		const updateMistakes = () => {
			mistakeCounter.textContent = format( strings.mistakes, {
				mistakes: levelMistakes,
			} );
		};

		const selectNumber = ( button, value ) => {
			if ( levelComplete || button.dataset.found === 'true' ) {
				return;
			}

			if ( value !== target ) {
				levelMistakes++;
				totalMistakes++;
				updateMistakes();
				status.textContent = format( strings.wrong, { target } );
				return;
			}

			button.dataset.found = 'true';
			button.setAttribute( 'aria-disabled', 'true' );
			button.setAttribute(
				'aria-label',
				format( strings.found_label, { number: value } )
			);
			button.textContent = '✓';
			target++;

			if ( target > levels[ levelIndex ] ) {
				levelComplete = true;
				panel.dataset.state = 'complete';
				status.textContent = format( strings.round_complete, {
					mistakes: levelMistakes,
				} );
				nextButton.textContent =
					levelIndex + 1 === levels.length
						? strings.finish
						: strings.next;
				nextButton.hidden = false;
				nextButton.focus();
				return;
			}

			updatePrompt();
			status.textContent = format( strings.correct, {
				next: target,
				number: value,
			} );
		};

		const renderLevel = () => {
			const maximum = levels[ levelIndex ];
			const values = shuffle(
				Array.from(
					{ length: maximum },
					( unused, index ) => index + 1
				)
			);

			target = 1;
			levelMistakes = 0;
			levelComplete = false;
			panel.dataset.state = 'playing';
			progress.textContent = format( strings.level, {
				current: levelIndex + 1,
				total: levels.length,
			} );
			updateMistakes();
			updatePrompt();
			status.textContent = strings.ready;
			nextButton.hidden = true;
			board.style.setProperty(
				'--focus-grid-size',
				String( Math.sqrt( maximum ) )
			);
			board.replaceChildren(
				...values.map( ( value ) => {
					const button = document.createElement( 'button' );
					button.type = 'button';
					button.textContent = String( value );
					button.dataset.focusGridNumber = String( value );
					button.setAttribute(
						'aria-label',
						format( strings.number_label, { number: value } )
					);
					button.addEventListener( 'click', () => {
						selectNumber( button, value );
					} );
					return button;
				} )
			);
		};

		const renderResults = () => {
			panel.hidden = true;
			results.hidden = false;
			summary.textContent = format(
				totalMistakes === 1 ? strings.complete_one : strings.complete,
				{
					mistakes: totalMistakes,
					total: levels.length,
				}
			);
			restartButton.textContent = strings.try_again;
			restartButton.focus();
		};

		const nextLevel = () => {
			if ( ! levelComplete ) {
				return;
			}

			levelIndex++;

			if ( levelIndex >= levels.length ) {
				renderResults();
				return;
			}

			renderLevel();
			board.focus();
		};

		const start = () => {
			levelIndex = 0;
			totalMistakes = 0;
			panel.hidden = false;
			results.hidden = true;
			renderLevel();
		};

		nextButton.addEventListener( 'click', nextLevel );
		restartButton.addEventListener( 'click', () => {
			start();
			board.focus();
		} );

		start();
	};

	document
		.querySelectorAll( '[data-cogpace-focus-grid]' )
		.forEach( initialize );
} )();
