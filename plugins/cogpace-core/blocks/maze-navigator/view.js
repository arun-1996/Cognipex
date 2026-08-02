( () => {
	'use strict';

	const initialize = ( root ) => {
		const panel = root.querySelector( '[data-maze-panel]' );
		const board = root.querySelector( '[data-maze-board]' );
		const progress = root.querySelector( '[data-maze-progress]' );
		const moveCounter = root.querySelector( '[data-maze-moves]' );
		const pointCounter = root.querySelector( '[data-maze-points]' );
		const directionButtons = Array.from(
			root.querySelectorAll( '[data-maze-direction]' )
		);
		const status = root.querySelector( '[data-maze-status]' );
		const nextButton = root.querySelector( '[data-maze-next]' );
		const results = root.querySelector( '[data-maze-results]' );
		const summary = root.querySelector( '[data-maze-summary]' );
		const restartButton = root.querySelector( '[data-maze-restart]' );

		if (
			! panel ||
			! board ||
			! progress ||
			! moveCounter ||
			! pointCounter ||
			directionButtons.length !== 4 ||
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
			levels = JSON.parse( root.dataset.levels || '[]' );
			strings = JSON.parse( root.dataset.strings || '{}' );
		} catch {
			return;
		}

		if ( ! Array.isArray( levels ) || levels.length === 0 ) {
			return;
		}

		let levelIndex = 0;
		let maze = [];
		let player = { column: 0, row: 0 };
		let goal = { column: 0, row: 0 };
		let levelMoves = 0;
		let totalMoves = 0;
		let points = 0;
		let levelComplete = false;

		const directions = {
			down: { column: 0, row: 1 },
			left: { column: -1, row: 0 },
			right: { column: 1, row: 0 },
			up: { column: 0, row: -1 },
		};

		const format = ( template, values = {} ) =>
			Object.entries( values ).reduce(
				( message, [ key, value ] ) =>
					message.replaceAll( `{${ key }}`, String( value ) ),
				template || ''
			);

		const findCell = ( character ) => {
			for ( let row = 0; row < maze.length; row++ ) {
				const column = maze[ row ].indexOf( character );

				if ( column !== -1 ) {
					return { column, row };
				}
			}

			return null;
		};

		const updateBoardLabel = () => {
			board.setAttribute(
				'aria-label',
				format( strings.board_label, {
					column: player.column + 1,
					goalColumn: goal.column + 1,
					goalRow: goal.row + 1,
					row: player.row + 1,
				} )
			);
		};

		const renderBoard = () => {
			const cells = [];

			maze.forEach( ( row, rowIndex ) => {
				Array.from( row ).forEach( ( cellValue, columnIndex ) => {
					const cell = document.createElement( 'span' );
					const isPlayer =
						player.row === rowIndex &&
						player.column === columnIndex;
					const isGoal =
						goal.row === rowIndex && goal.column === columnIndex;

					cell.className = 'cogpace-maze-navigator__cell';
					cell.setAttribute( 'aria-hidden', 'true' );

					if ( cellValue === '#' ) {
						cell.classList.add( 'is-wall' );
					}

					if ( isGoal ) {
						cell.classList.add( 'is-goal' );
						cell.textContent = '★';
					}

					if ( isPlayer ) {
						cell.classList.add( 'is-player' );
						cell.textContent = '●';
					}

					cells.push( cell );
				} );
			} );

			board.style.setProperty(
				'--maze-size',
				String( maze[ 0 ].length )
			);
			board.replaceChildren( ...cells );
			updateBoardLabel();
		};

		const setControlsDisabled = ( disabled ) => {
			directionButtons.forEach( ( button ) => {
				button.disabled = disabled;
			} );
		};

		const renderLevel = () => {
			maze = levels[ levelIndex ];

			if (
				! Array.isArray( maze ) ||
				maze.length === 0 ||
				! maze.every(
					( row ) =>
						typeof row === 'string' &&
						row.length === maze[ 0 ].length
				)
			) {
				return;
			}

			const start = findCell( 'S' );
			const destination = findCell( 'G' );

			if ( ! start || ! destination ) {
				return;
			}

			player = start;
			goal = destination;
			levelMoves = 0;
			levelComplete = false;
			panel.dataset.state = 'playing';
			progress.textContent = format( strings.level, {
				current: levelIndex + 1,
				total: levels.length,
			} );
			moveCounter.textContent = format( strings.moves, { moves: 0 } );
			pointCounter.textContent = format( strings.points, { points } );
			status.textContent = strings.ready;
			nextButton.hidden = true;
			setControlsDisabled( false );
			renderBoard();
		};

		const renderResults = () => {
			panel.hidden = true;
			results.hidden = false;
			summary.textContent = format(
				Math.abs( points ) === 1
					? strings.complete_one
					: strings.complete,
				{
					moves: totalMoves,
					points,
					total: levels.length,
				}
			);
			restartButton.textContent = strings.try_again;
			restartButton.focus();
		};

		const move = ( directionName ) => {
			if ( levelComplete || ! directions[ directionName ] ) {
				return;
			}

			const direction = directions[ directionName ];
			const next = {
				column: player.column + direction.column,
				row: player.row + direction.row,
			};
			const isOutside =
				next.row < 0 ||
				next.row >= maze.length ||
				next.column < 0 ||
				next.column >= maze[ 0 ].length;

			if ( isOutside || maze[ next.row ][ next.column ] === '#' ) {
				points--;
				pointCounter.textContent = format( strings.points, { points } );
				status.textContent = strings.blocked;
				return;
			}

			player = next;
			levelMoves++;
			totalMoves++;
			moveCounter.textContent = format( strings.moves, {
				moves: levelMoves,
			} );
			renderBoard();

			if ( player.row === goal.row && player.column === goal.column ) {
				levelComplete = true;
				panel.dataset.state = 'complete';
				status.textContent = format( strings.reached, {
					moves: levelMoves,
				} );
				setControlsDisabled( true );
				nextButton.textContent =
					levelIndex + 1 === levels.length
						? strings.finish
						: strings.next;
				nextButton.hidden = false;
				nextButton.focus();
				return;
			}

			status.textContent = format( strings.moved, {
				column: player.column + 1,
				direction: directionName,
				row: player.row + 1,
			} );
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
			totalMoves = 0;
			points = 0;
			panel.hidden = false;
			results.hidden = true;
			renderLevel();
		};

		directionButtons.forEach( ( button ) => {
			button.addEventListener( 'click', () => {
				move( button.dataset.mazeDirection );
			} );
		} );
		board.addEventListener( 'keydown', ( event ) => {
			const keyDirections = {
				ArrowDown: 'down',
				ArrowLeft: 'left',
				ArrowRight: 'right',
				ArrowUp: 'up',
			};
			const direction = keyDirections[ event.key ];

			if ( direction ) {
				event.preventDefault();
				move( direction );
			}
		} );
		nextButton.addEventListener( 'click', nextLevel );
		restartButton.addEventListener( 'click', () => {
			start();
			board.focus();
		} );

		start();
	};

	document
		.querySelectorAll( '[data-cogpace-maze-navigator]' )
		.forEach( initialize );
} )();
