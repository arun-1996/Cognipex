# True or False game

## Product boundary

True or False is a ten-question general-knowledge activity that exercises recall, comparison, and judgment. It provides an explanation after every answer and a simple final score. It is educational practice, not an intelligence, diagnostic, screening, treatment, or guaranteed-improvement tool.

The initial question bank uses stable arithmetic, geometry, language, science, and general-knowledge statements. New or revised questions require factual and editorial review. Avoid health, political, rapidly changing, ambiguous, trick, culturally exclusionary, or unsupported claims.

## Rendering and data boundary

- Stable game key: `true-or-false`.
- Cogpace Core owns the server-rendered `cogpace/true-or-false` block, scoped CSS, question bank, scoring rules, and dependency-free JavaScript state machine.
- The block theme places the dynamic block in the shared single-game template. Each game block renders only when its game key matches the current cognitive-game record.
- All ten questions appear once per round in a shuffled order. A correct answer adds one point; there is no penalty or timer.
- Answers and scores exist only in JavaScript memory. The runtime uses no cookies, browser storage, REST requests, analytics events, user identifiers, or server writes. Reloading or leaving the page clears them.

## Interaction and accessibility

1. The first statement appears when the block initializes.
2. The statement labels a native-button group containing True and False choices.
3. After a choice, both answer buttons are disabled, explanatory feedback is written to a polite atomic live region, and focus moves to the next-step button.
4. The next-step label changes to “See results” on the final question.
5. At completion, the question panel is hidden, the textual score is shown, and focus moves to “Play again.”
6. Starting another round reshuffles the questions, clears the score, and returns focus to the first answer.

The activity has no time limit, animation, flashing, audio, or motion. Native buttons support keyboard, pointer, and touch input. State is communicated through text as well as border color.

## Performance and advertising

- No third-party dependency or gameplay network request.
- JavaScript target: under 8 KB uncompressed; CSS target: under 6 KB uncompressed.
- Test current Chromium, Firefox, and Safari families; keyboard, touch, and pointer input; 320px reflow; and 200% and 400% zoom equivalents.
- No advertisement may render inside the game block, between the statement and answers, as an overlay, or in a way that shifts the game during play.

## Editorial record

Create or publish a `cogpace_game` record through the normal WordPress editorial workflow and set `cogpace_game_key` to `true-or-false`. Assign at least one reviewed Cognitive Domain term, and provide a title, excerpt, instructions, and accessibility notes. The game block does not create or modify editorial content automatically.
