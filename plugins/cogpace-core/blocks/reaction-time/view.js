( () => {
	'use strict';

	const initialize = ( root ) => {
		const panel = root.querySelector( '.cogpace-reaction-time__panel' );
		const status = root.querySelector( '.cogpace-reaction-time__status' );
		const target = root.querySelector( '[data-reaction-target]' );
		const start = root.querySelector( '[data-reaction-start]' );
		const results = root.querySelector( '[data-reaction-results]' );
		const summary = root.querySelector( '[data-reaction-summary]' );
		const resultList = root.querySelector( '[data-reaction-list]' );

		if (
			! panel ||
			! status ||
			! target ||
			! start ||
			! results ||
			! summary ||
			! resultList
		) {
			return;
		}

		const trialLimit = Number.parseInt( root.dataset.trials || '5', 10 );
		const strings = JSON.parse( root.dataset.strings || '{}' );

		let timeoutId = null;
		let signalTime = 0;
		let state = 'idle';
		let trials = [];
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

		const randomDelay = () => 1500 + Math.floor( Math.random() * 2501 );

		const renderResults = () => {
			const average = Math.round(
				trials.reduce( ( total, time ) => total + time, 0 ) /
					trials.length
			);

			summary.textContent = format( strings.average, {
				average,
				count: trials.length,
			} );
			resultList.replaceChildren();

			trials.forEach( ( time, index ) => {
				const item = document.createElement( 'li' );
				item.textContent = format( strings.trial, {
					trial: index + 1,
					time: Math.round( time ),
				} );
				resultList.append( item );
			} );

			results.hidden = false;
			start.disabled = false;
			start.textContent = strings.try_again;
			setStatus( strings.complete );
			setState( 'complete' );
			start.focus();
		};

		const scheduleSignal = () => {
			cancelTimer();
			setState( 'waiting' );
			target.disabled = false;
			target.textContent = strings.wait;
			setStatus(
				format( strings.waiting, {
					trial: trials.length + 1,
					total: trialLimit,
				} )
			);

			timeoutId = window.setTimeout( () => {
				timeoutId = null;
				signalTime = performance.now();
				setState( 'ready' );
				target.textContent = strings.respond_now;
				setStatus(
					format( strings.signal, { trial: trials.length + 1 } )
				);
			}, randomDelay() );
		};

		const begin = () => {
			cancelTimer();
			trials = [];
			results.hidden = true;
			resultList.replaceChildren();
			start.disabled = true;
			target.disabled = false;
			target.focus();
			scheduleSignal();
		};

		const respond = () => {
			if ( state === 'waiting' ) {
				cancelTimer();
				setState( 'early' );
				target.textContent = strings.too_soon;
				setStatus( strings.early );
				timeoutId = window.setTimeout( scheduleSignal, 1200 );
				return;
			}

			if ( state !== 'ready' ) {
				return;
			}

			trials.push( performance.now() - signalTime );
			target.disabled = true;

			if ( trials.length >= trialLimit ) {
				renderResults();
				return;
			}

			setState( 'recorded' );
			setStatus(
				format( strings.preparing, {
					trial: trials.length,
					next: trials.length + 1,
				} )
			);
			target.textContent = strings.recorded;
			timeoutId = window.setTimeout( scheduleSignal, 900 );
		};

		const cancelForVisibility = () => {
			if (
				! document.hidden ||
				state === 'idle' ||
				state === 'complete'
			) {
				return;
			}

			cancelTimer();
			setState( 'idle' );
			trials = [];
			target.disabled = true;
			target.textContent = strings.response_button;
			start.disabled = false;
			start.textContent = strings.start;
			results.hidden = true;
			setStatus( strings.hidden_reset );
		};

		start.addEventListener( 'click', begin );
		target.addEventListener( 'click', respond );
		document.addEventListener( 'visibilitychange', cancelForVisibility );
	};

	document
		.querySelectorAll( '[data-cogpace-reaction-time]' )
		.forEach( initialize );
} )();
