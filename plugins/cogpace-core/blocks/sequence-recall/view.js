( () => {
	'use strict';

	const initialize = ( root ) => {
		const panel = root.querySelector( '[data-sequence-panel]' );
		const status = root.querySelector( '[data-sequence-status]' );
		const tiles = Array.from(
			root.querySelectorAll( '[data-sequence-tile]' )
		);
		const startButton = root.querySelector( '[data-sequence-start]' );
		const replayButton = root.querySelector( '[data-sequence-replay]' );
		const nextButton = root.querySelector( '[data-sequence-next]' );
		const results = root.querySelector( '[data-sequence-results]' );
		const summary = root.querySelector( '[data-sequence-summary]' );
		const reveal = root.querySelector( '[data-sequence-reveal]' );
		const restartButton = root.querySelector( '[data-sequence-restart]' );

		if (
			! panel ||
			! status ||
			tiles.length < 2 ||
			! startButton ||
			! replayButton ||
			! nextButton ||
			! results ||
			! summary ||
			! reveal ||
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

		const roundLimit = Number.parseInt( root.dataset.rounds || '5', 10 );
		const startLength = Number.parseInt(
			root.dataset.startLength || '3',
			10
		);
		const itemDuration = 650;
		const itemGap = 250;
		const labels = tiles.map( ( tile ) => tile.dataset.label || '' );

		let timeoutId = null;
		let state = 'idle';
		let sequence = [];
		let input = [];
		let roundIndex = 0;
		let completedRounds = 0;

		const format = ( template, values = {} ) =>
			Object.entries( values ).reduce(
				( message, [ key, value ] ) =>
					message.replaceAll( `{${ key }}`, String( value ) ),
				template || ''
			);

		const setStatus = ( message ) => {
			status.textContent = message;
		};

		const setState = ( nextState ) => {
			state = nextState;
			panel.dataset.state = nextState;
		};

		const cancelTimer = () => {
			if ( timeoutId !== null ) {
				window.clearTimeout( timeoutId );
				timeoutId = null;
			}
		};

		const clearActiveTile = () => {
			tiles.forEach( ( tile ) => {
				delete tile.dataset.active;
			} );
		};

		const enableTiles = ( enabled ) => {
			tiles.forEach( ( tile ) => {
				tile.disabled = ! enabled;
			} );
		};

		const randomValue = () => Math.floor( Math.random() * tiles.length );

		const beginInput = () => {
			cancelTimer();
			clearActiveTile();
			input = [];
			setState( 'input' );
			enableTiles( true );
			replayButton.disabled = false;
			setStatus( format( strings.choose, { total: sequence.length } ) );
			tiles[ 0 ].focus();
		};

		const playSequence = () => {
			cancelTimer();
			clearActiveTile();
			setState( 'watching' );
			enableTiles( false );
			replayButton.hidden = false;
			replayButton.disabled = true;
			nextButton.hidden = true;
			setStatus(
				format( strings.watch_intro, { round: roundIndex + 1 } )
			);

			let playbackIndex = 0;
			const showNext = () => {
				clearActiveTile();

				if ( playbackIndex >= sequence.length ) {
					timeoutId = window.setTimeout( beginInput, itemGap );
					return;
				}

				const value = sequence[ playbackIndex ];
				tiles[ value ].dataset.active = 'true';
				setStatus(
					format( strings.watch, {
						current: playbackIndex + 1,
						label: labels[ value ],
						total: sequence.length,
					} )
				);

				timeoutId = window.setTimeout( () => {
					clearActiveTile();
					playbackIndex++;
					timeoutId = window.setTimeout( showNext, itemGap );
				}, itemDuration );
			};

			timeoutId = window.setTimeout( showNext, itemGap );
		};

		const longestSequence = () =>
			completedRounds === 0 ? 0 : startLength + completedRounds - 1;

		const finish = ( wonAllRounds ) => {
			cancelTimer();
			clearActiveTile();
			enableTiles( false );
			setState( 'complete' );
			panel.hidden = true;
			results.hidden = false;
			summary.textContent = format(
				wonAllRounds ? strings.complete : strings.mistake,
				{
					length: longestSequence(),
					rounds: completedRounds,
					total: roundLimit,
				}
			);

			if ( wonAllRounds ) {
				reveal.hidden = true;
				reveal.textContent = '';
			} else {
				reveal.hidden = false;
				reveal.textContent = format( strings.reveal, {
					sequence: sequence
						.map( ( value ) => labels[ value ] )
						.join( ', ' ),
				} );
			}

			restartButton.textContent = strings.try_again;
			restartButton.focus();
		};

		const choose = ( value ) => {
			if ( state !== 'input' ) {
				return;
			}

			replayButton.disabled = true;
			const expected = sequence[ input.length ];

			if ( value !== expected ) {
				finish( false );
				return;
			}

			input.push( value );

			if ( input.length < sequence.length ) {
				setStatus(
					format( strings.input_progress, {
						current: input.length,
						total: sequence.length,
					} )
				);
				return;
			}

			completedRounds++;
			enableTiles( false );
			replayButton.disabled = true;

			if ( completedRounds >= roundLimit ) {
				finish( true );
				return;
			}

			setState( 'between-rounds' );
			setStatus(
				format( strings.round_complete, { round: roundIndex + 1 } )
			);
			nextButton.textContent = format( strings.next, {
				round: roundIndex + 2,
			} );
			nextButton.hidden = false;
			nextButton.focus();
		};

		const start = () => {
			cancelTimer();
			sequence = Array.from( { length: startLength }, randomValue );
			input = [];
			roundIndex = 0;
			completedRounds = 0;
			panel.hidden = false;
			results.hidden = true;
			startButton.hidden = true;
			nextButton.hidden = true;
			playSequence();
		};

		const nextRound = () => {
			if ( state !== 'between-rounds' ) {
				return;
			}

			roundIndex++;
			sequence.push( randomValue() );
			playSequence();
		};

		const replay = () => {
			if (
				state !== 'interrupted' &&
				( state !== 'input' || input.length > 0 )
			) {
				return;
			}

			playSequence();
		};

		const cancelForVisibility = () => {
			if ( ! document.hidden || state !== 'watching' ) {
				return;
			}

			cancelTimer();
			clearActiveTile();
			setState( 'interrupted' );
			replayButton.disabled = false;
			setStatus( strings.hidden );
		};

		tiles.forEach( ( tile ) => {
			tile.addEventListener( 'click', () => {
				choose( Number.parseInt( tile.dataset.sequenceTile, 10 ) );
			} );
		} );

		root.addEventListener( 'keydown', ( event ) => {
			if ( state !== 'input' || ! /^[1-4]$/.test( event.key ) ) {
				return;
			}

			const tile = tiles[ Number.parseInt( event.key, 10 ) - 1 ];

			if ( ! tile ) {
				return;
			}

			event.preventDefault();
			tile.focus();
			tile.click();
		} );

		startButton.addEventListener( 'click', start );
		replayButton.addEventListener( 'click', replay );
		nextButton.addEventListener( 'click', nextRound );
		restartButton.addEventListener( 'click', start );
		document.addEventListener( 'visibilitychange', cancelForVisibility );
	};

	document
		.querySelectorAll( '[data-cogpace-sequence-recall]' )
		.forEach( initialize );
} )();
