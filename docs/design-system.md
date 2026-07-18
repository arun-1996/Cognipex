# Design system

## Status

The initial product direction is a restrained dark interface: a near-black canvas, layered dark surfaces, off-white text, and low-opacity white-tinted shadows. `theme.json` is the approved source of truth for these foundations.

Do not add components or patterns until their requirements are approved.

## Approved foundation direction

- Use near-black rather than pure black for the page canvas.
- Use dark surface layers and subtle borders to separate content.
- Use off-white text with a muted-text token for secondary content.
- Use white-tinted shadows sparingly to signal elevation; do not use bright glows as decoration.
- Use the approved accent tokens only for meaningful action, state, or emphasis.
- Preserve WCAG 2.2 AA contrast for every foreground/background pairing.

## Intended model

Use a block-theme `theme.json` as the canonical distribution point for approved tokens and editor constraints. Keep tokens semantic (for example, `color.text.default`) rather than tied to a visual value or component.

| Layer | Purpose |
| --- | --- |
| Foundations | Color, type, spacing, radius, elevation, motion |
| Semantics | Named tokens for intent and state |
| Components | Accessible, reusable block and interface patterns |
| Templates | Composed page and content layouts |

## Non-negotiables

- Meet WCAG 2.2 AA for supported experiences.
- Preserve keyboard operation, visible focus, and logical heading order.
- Respect reduced-motion preferences.
- Test authoring and front-end experiences in the block editor before release.
