# Reaction Time game

## Product and evidence boundary

The first game is a five-trial simple visual reaction-time activity. A simple reaction-time task records the latency between a signal and a response, but browser, operating-system, display, device, input method, motor response, attention, fatigue, and surroundings can all influence the value. Research also shows that hardware/software delay materially affects computer-based measurements; Cogpace therefore labels results as approximate and does not compare users or apply normative bands. See Woods et al., [“Factors influencing the latency of simple reaction time”](https://pmc.ncbi.nlm.nih.gov/articles/PMC4374455/).

The activity offers educational practice related to attention and response speed. It is not a diagnostic, screening, treatment, rehabilitation, intelligence, or guaranteed-improvement tool.

## Rendering and data boundary

- Stable game key: `reaction-time`.
- Cogpace Core owns the server-rendered `cogpace/reaction-time` block, scoped CSS, and dependency-free JavaScript state machine.
- The block theme owns the single-game template and places the dynamic block after editorial instructions.
- Five recorded trials produce an arithmetic mean and individual trial list.
- Results exist only in JavaScript memory. The runtime uses no cookies, local/session storage, REST requests, analytics events, user identifiers, or server writes. Reloading or leaving the page clears them.

## Interaction and focus model

1. The user starts a session with a standard button.
2. Focus moves to the large response button as a direct consequence of that action.
3. The response button remains in the tab order and works with pointer, touch, Enter, and Space through native button behavior.
4. An early response is announced, does not count as a recorded trial, and schedules another signal.
5. After each valid response, persistent status text announces progress.
6. After trial five, focus returns to the restart button and results are exposed as text and an ordered list.

The visual state is never the only state signal. A polite atomic live region provides readiness, signal, false-start, progress, cancellation, and completion text.

## Timing accessibility

Timing is intrinsic only to the measurement between the visible signal and the user's response. There is no response deadline: the signal remains until the user responds. Instructions and results never expire. This avoids requiring the user to extend or disable an operational time limit while preserving the nature of the activity. The model follows the intent of W3C guidance for [Timing Adjustable](https://www.w3.org/WAI/WCAG22/Understanding/timing-adjustable.html).

The pre-signal wait is randomized between 1.5 and 4 seconds to discourage anticipation. It determines neither access nor score. An early activation restarts the wait. If the page becomes hidden during a session, the current session is cancelled and all trials are cleared so background-tab throttling cannot create a misleading result.

## Motion and visual behavior

The runtime introduces no animation, automatic movement, countdown, flashing, vibration, or audio. The signal is an immediate background, border, text, and live-region state change. Reduced-motion mode is therefore behaviorally identical and needs no animation override.

## Performance budget and device matrix

- No third-party dependency and no network request during play.
- JavaScript target: under 8 KB uncompressed; CSS target: under 6 KB uncompressed.
- No layout shift after initial render other than revealing the results below the game panel after completion.
- Test current Chromium, Firefox, and Safari families on desktop; current Safari/Chromium mobile families; keyboard, touch, and pointer; 320px reflow; 200% and 400% zoom equivalents; and reduced motion.
- Browser timing is approximate. The runtime must never claim laboratory precision.

## Advertising constraint

No advertisement may render inside the game block, between its status and response control, or as an overlay. Ads must not animate, steal focus, move the game, delay input, or create layout shift during play. No advertising provider is integrated in this milestone.

## Recovery and validation

- JavaScript absence leaves explanatory content and a `noscript` notice.
- A missing expected element causes initialization to stop without affecting surrounding content.
- Hiding the tab resets the session and enables a clean restart.
- Completion requires five valid trials; false starts never enter the result list.
