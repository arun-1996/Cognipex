# Rule Switch game

## Purpose and limits

Rule Switch is a twelve-round cognitive-flexibility activity. The player classifies a number using alternating odd/even and low/high rules. It offers educational practice in reading and applying a changing rule; it is not a diagnostic, screening, treatment, rehabilitation, intelligence, or guaranteed-improvement tool.

## Runtime contract

- Stable game key: `rule-switch`.
- Dynamic block: `cogpace/rule-switch`.
- The shared single-game template places the block, and the block renders only when its game key matches the current cognitive-game record.
- A session contains twelve untimed rounds. The first rule is randomized, then odd/even and low/high alternate.
- Numbers range from 1 through 9 and do not repeat on consecutive rounds.
- Low means 1–4 and high means 5–9. The visible rule states this boundary whenever it applies.
- The score is the number of correct first answers. There are no normative bands, rankings, or claims about broader cognitive ability.

## Privacy and dependencies

- Rounds, answers, and results exist only in JavaScript memory.
- The runtime uses no cookies, browser storage, REST requests, analytics events, user identifiers, server writes, third-party dependencies, or gameplay network requests.
- Reloading or leaving the page clears the session.

## Accessibility behavior

- The current rule, number, progress, and answer choices are always available as text; color is never the only cue.
- Each answer is a native button with a visible focus treatment and a minimum 48-pixel target.
- After an answer, both choices are disabled, feedback is written to a polite atomic live region, and focus moves to the next-round button.
- The next round moves focus to the first answer. Completion and replay move focus to the replay button and first answer respectively.
- The game has no timer, animation, flashing, drag interaction, audio requirement, or hidden keyboard shortcut.
- Without JavaScript, the surrounding editorial content and an explanatory fallback remain available.

## Editorial record

Create or publish a `cogpace_game` record through the normal WordPress editorial workflow and set `cogpace_game_key` to `rule-switch`. Assign a reviewed Cognitive Domain term, and provide a title, excerpt, instructions, accessibility notes, and optional evidence reference. The block does not create or modify editorial content automatically.
