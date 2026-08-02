# Sequence Recall game

## Product boundary

Sequence Recall is a five-round working-memory activity. The player watches a sequence of numbered shapes and then reproduces it in the same order. A successful round adds one item, progressing from three to seven items. The activity offers educational memory practice; it is not an intelligence, diagnostic, screening, treatment, rehabilitation, or guaranteed-improvement tool.

## Rendering and data boundary

- Stable game key: `sequence-recall`.
- Cogpace Core owns the server-rendered `cogpace/sequence-recall` block, scoped CSS, random sequence generation, playback, input checking, scoring, and dependency-free JavaScript state machine.
- The shared single-game template places the block, and the block renders only when its game key matches the current cognitive-game record.
- A session begins with three random items. Each completed round keeps the existing sequence and appends one random item, up to seven items in round five.
- The session ends after the first incorrect item or after all five rounds. The result reports completed rounds and the longest correctly recalled sequence; an incorrect round also reveals its sequence as text.
- Sequences and results exist only in JavaScript memory. The runtime uses no cookies, browser storage, REST requests, analytics events, user identifiers, or server writes. Reloading or leaving the page clears them.

## Perception and interaction model

- Four native buttons are identified by number, shape name, visible symbol, and color. Color is never the only cue.
- Sequence items appear one at a time with an immediate state change and live-region text. There are no fades, translations, scaling effects, vibration, or audio.
- The player starts every playback explicitly. A sequence may be replayed before the first response without a penalty.
- There is no response deadline. After playback, focus moves to the first choice, and the player can use Tab and Enter or Space, pointer/touch input, or number keys 1–4.
- After a successful round, focus moves to the next-round button. At completion, focus moves to the replay-session button.
- If the page becomes hidden during playback, the timer is cancelled and the player is prompted to replay the full sequence.

Playback uses a single highlight at a time, well below three flashes per second. Reduced-motion behavior is identical because the runtime and stylesheet introduce no animation or transition. Text announcements provide the same ordered labels to users who do not perceive the visual highlight.

## Performance and advertising

- No third-party dependency or gameplay network request.
- JavaScript target: under 8 KB uncompressed; CSS target: under 6 KB uncompressed.
- Test current Chromium, Firefox, and Safari families; keyboard, touch, pointer, and number-key input; 320px reflow; 200% and 400% zoom equivalents; tab visibility changes; and reduced motion.
- No advertisement may render inside the game block, interrupt playback, cover controls, take focus, or shift the game during a session.

## Editorial record

Create or publish a `cogpace_game` record through the normal WordPress editorial workflow and set `cogpace_game_key` to `sequence-recall`. Assign at least one reviewed Cognitive Domain term, and provide a title, excerpt, instructions, and accessibility notes. The block does not create or modify editorial content automatically.
