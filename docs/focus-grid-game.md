# Focus Grid game

## Purpose and limits

Focus Grid is a three-round visual-scanning activity. The player finds shuffled numbers in ascending order across progressively larger grids. It offers sustained-attention and visual-search practice; it is not a diagnostic, screening, treatment, rehabilitation, or guaranteed way to improve attention span or focus.

## Runtime contract

- Stable game key: `focus-grid`.
- Dynamic block: `cogpace/focus-grid`.
- The shared single-game template places the block, and the block renders only when its game key matches the current cognitive-game record.
- A session progresses through shuffled 3-by-3, 4-by-4, and 5-by-5 number grids.
- The player selects every number in ascending order. Correct selections become persistent checkmarks; incorrect selections add one mistake without resetting progress.
- Completing the third grid reports the session mistake count without a timer, rankings, normative bands, or claims about broader attention ability.

## Privacy and dependencies

- Grid order, selections, and mistake counts exist only in JavaScript memory.
- The runtime uses no cookies, browser storage, REST requests, analytics events, user identifiers, server writes, third-party dependencies, or gameplay network requests.
- Reloading or leaving the page clears the session.

## Accessibility behavior

- Every grid item is a native button with a text number, accessible name, visible focus treatment, and minimum 48-pixel target.
- Correct selections use a checkmark, border, text, and background treatment rather than color alone.
- The current target is exposed as a heading and as the number-grid accessible label.
- Correct selections, mistakes, and round completion are announced through a polite atomic live region.
- Completing a grid moves focus to the next-step button. Starting the next grid or replaying moves focus to the grid container.
- The game has no timer, flashing, drag requirement, audio requirement, or hidden shortcut.
- Without JavaScript, the surrounding editorial content and an explanatory fallback remain available.

## Editorial record

Create or publish a `cogpace_game` record through the normal WordPress editorial workflow and set `cogpace_game_key` to `focus-grid`. Assign a reviewed Cognitive Domain term, and provide a title, excerpt, instructions, accessibility notes, and optional evidence reference. The block does not create or modify editorial content automatically.
