# Maze Navigator game

## Purpose and limits

Maze Navigator is a five-level spatial navigation activity. The player moves a dot through a visible grid to reach a star while avoiding walls. It offers educational practice in route planning, attention, and spatial interaction; it is not a diagnostic, screening, treatment, rehabilitation, intelligence, or guaranteed-improvement tool.

## Runtime contract

- Stable game key: `maze-navigator`.
- Dynamic block: `cogpace/maze-navigator`.
- The shared single-game template places the block, and the block renders only when its game key matches the current cognitive-game record.
- A session contains five reviewed six-by-six mazes with one start, one goal, solid walls, and at least one valid route.
- Players move one cell at a time. Valid moves increase the level and session move counts. Each blocked or out-of-bounds attempt subtracts one point from a session score that starts at zero.
- Reaching the star completes the maze and exposes the next-step control. Completing the fifth maze reports the session move count and wall-penalty score without rankings or normative bands.

## Privacy and dependencies

- Position, routes, move counts, and points exist only in JavaScript memory.
- The runtime uses no cookies, browser storage, REST requests, analytics events, user identifiers, server writes, third-party dependencies, or gameplay network requests.
- Reloading or leaving the page clears the session.

## Accessibility behavior

- The dot, star, and patterned walls remain distinguishable without relying on color alone.
- The focusable maze exposes the current player and goal coordinates as an accessible name.
- Arrow keys on the focused maze and four labeled native direction buttons provide equivalent input.
- Direction buttons have visible focus treatment and minimum 52-pixel touch targets.
- Blocked moves, valid moves, and goal completion are announced through a polite atomic live region.
- Reaching a goal moves focus to the next-step button. Starting the next maze or replaying moves focus to the maze.
- The game has no timer, flashing, drag requirement, audio requirement, or hidden shortcut.
- Without JavaScript, the surrounding editorial content and an explanatory fallback remain available.

## Editorial record

Create or publish a `cogpace_game` record through the normal WordPress editorial workflow and set `cogpace_game_key` to `maze-navigator`. Assign reviewed Cognitive Domain terms, and provide a title, excerpt, instructions, accessibility notes, and optional evidence reference. The block does not create or modify editorial content automatically.
