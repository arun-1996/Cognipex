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

## Motion policy

Motion is optional enhancement, never the only way Cogpace communicates content, state, progress, success, or error. The default experience is calm and restrained. This policy applies to the public site, the editor representation of custom components, and interactive games.

The policy intentionally exceeds the WCAG 2.2 AA baseline by also adopting the intent of [Success Criterion 2.3.3: Animation from Interactions](https://www.w3.org/WAI/WCAG22/Understanding/animation-from-interactions). Automatically started movement must also satisfy [Success Criterion 2.2.2: Pause, Stop, Hide](https://www.w3.org/WAI/WCAG22/Understanding/pause-stop-hide.html), and no experience may violate the WCAG flashing thresholds.

### Motion tokens

`theme.json` owns the approved duration and easing tokens. WordPress exposes these custom settings as CSS custom properties with the `--wp--custom--motion--` prefix.

| Token | Value | Intended use |
| --- | --- | --- |
| `duration.instant` | `0ms` | Reduced-motion replacement and state changes that must be immediate |
| `duration.fast` | `120ms` | Hover, pressed, and simple control feedback |
| `duration.standard` | `180ms` | Small state transitions within a component |
| `duration.slow` | `240ms` | Rare entrances or exits that benefit from extra context |
| `easing.standard` | `cubic-bezier(0.2, 0, 0, 1)` | Default transition curve |
| `easing.enter` | `cubic-bezier(0, 0, 0.2, 1)` | An approved element becoming visible |
| `easing.exit` | `cubic-bezier(0.4, 0, 1, 1)` | An approved element becoming hidden |

Use the shortest token that makes a change understandable. Component CSS must reference these variables rather than introduce one-off durations or easing curves. A transition longer than `duration.slow` requires an explicit component-level accessibility and product decision recorded in `wp-content/docs/`.

### Allowed motion

- Use short transitions for color, background color, border color, opacity, or shadow when they clarify an intentional state change.
- Use a small transform only when it conveys spatial context that cannot be communicated as clearly with a static change. It must remain non-essential and disappear in reduced-motion mode.
- Start feedback only after an intentional user action. Hover feedback must have an equivalent focus state, and focus visibility must appear immediately.
- Keep loading and progress feedback semantic. Prefer status text and native progress semantics over rotating indicators, shimmer, or pulsing placeholders.
- Keep page and content navigation immediate. Smooth scrolling, parallax, scroll-jacking, and decorative scroll-triggered entrances are not approved.

### Prohibited motion

- No autoplaying, decorative, continuously looping, blinking, flashing, bouncing, or attention-seeking motion.
- No motion that changes reading order, moves a focused control, obscures focus, delays input, or blocks access to content.
- No animation of layout properties such as width, height, margin, padding, or position for decoration.
- No motion-only instructions or outcomes. Pair state changes with persistent text, icons with accessible names, or appropriate live-region announcements.
- No animation library or new runtime dependency solely for motion without an approved, documented architectural decision.

### Reduced-motion contract

Every component that introduces non-essential motion must include a colocated `prefers-reduced-motion: reduce` rule. Reduced-motion mode must:

- replace non-essential transition and animation durations with `duration.instant`;
- remove transforms, smooth scrolling, parallax, and simulated camera movement;
- present the final state without requiring the animation to complete; and
- retain state feedback, focus visibility, operability, and understandable timing.

Do not add a global wildcard animation reset. A component owns its motion and its reduced-motion alternative so an essential behavior is not accidentally disabled elsewhere.

Example for a future approved component:

```css
.component {
  transition: color var(--wp--custom--motion--duration--fast)
    var(--wp--custom--motion--easing--standard);
}

@media (prefers-reduced-motion: reduce) {
  .component {
    transition-duration: var(--wp--custom--motion--duration--instant);
  }
}
```

### Interactive games and timed experiences

- Animation must not start a timer, determine score accuracy, or hide the exact moment at which input becomes valid.
- Countdowns, readiness, results, and errors require persistent textual or programmatic state; visual motion may only reinforce them.
- Pausing, restarting, focus loss, background-tab behavior, and reduced motion must be decided for each game before implementation.
- Advertising and unrelated page effects must not animate during gameplay or compete with game feedback.
- Any motion considered essential requires a documented rationale, a non-motion equivalent where technically possible, and an explicit accessibility review.

### Performance limits

- Prefer no animation. When motion is justified, prefer opacity and transform over properties that trigger repeated layout; use paint-heavy effects such as shadow changes sparingly.
- Do not run decorative animation while idle or off-screen. Stop and clean up JavaScript-driven motion when a component unmounts, loses relevance, or becomes hidden.
- Motion must not introduce layout shift or delay input response. It must remain smooth on the component's supported-device test matrix and under browser zoom.
- Do not add JavaScript for an effect achievable with a small scoped CSS transition.

### Component approval and verification

Before merging a component with motion, document what the motion communicates, why a static state is insufficient, which tokens and properties it uses, and how reduced-motion mode behaves. Verify all of the following:

1. Keyboard, pointer, and touch interactions expose the same persistent state.
2. Focus is never moved, hidden, delayed, or animated away.
3. With reduced motion enabled, non-essential motion is absent and the workflow remains understandable.
4. At 200% and 400% zoom and narrow reflow widths, motion causes no clipping, overlap, or layout shift.
5. Loading, success, error, and game states remain understandable when CSS animation is disabled.
6. The browser performance profile shows no avoidable repeated layout, long task, or input delay caused by motion.

## Component responsive contracts

Responsive behavior is owned by each implemented component. Fluid design tokens remain the default; a component may add a scoped breakpoint only when its content and interaction model require one.

### Site header

The site header uses the `.cogpace-site-header` scope and the core Site Title and Navigation blocks.

- At narrow widths, the header may wrap naturally. The site title remains readable, the navigation stays aligned to the trailing edge, and the core Navigation block owns its accessible mobile overlay behavior.
- At `37.5rem` and wider, the header stays on one row. This is a component breakpoint, not a global breakpoint token.
- The header uses the global wide content size, fluid page gutters supplied by `theme.json`, and spacing presets rather than fixed component padding.
- Long site titles may wrap within their available space instead of forcing horizontal scrolling.
- The mobile navigation opener has a minimum `2.75rem` by `2.75rem` target. Header links and buttons receive an immediate, high-contrast `:focus-visible` outline.
- The component introduces no motion. Reduced-motion behavior therefore matches the default rendering.
- The block theme enqueues `style.css` for scoped component rules. Foundations and global element styles remain owned by `theme.json`.

Verify the header at narrow (`320px`), medium (`768px`), and wide (`1280px`) viewports, at 200% and 400% browser zoom or their equivalent reflow widths, with keyboard-only navigation, and with the mobile overlay open. It must not create horizontal page overflow, clip the site title or menu control, obscure focus, or change document order.

### Homepage, cards, and game surfaces

- The homepage hero may use a local, muted, looping video as a decorative background. The complete message and primary action remain available as foreground text, and the video is hidden when reduced motion is requested.
- The homepage hero uses fluid type and spacing tokens and requires no component breakpoint. Its heading wraps naturally and keeps a readable measure.
- Feature, article, game, statistic, and research cards use WordPress grid layout with a minimum useful column width. They collapse to one column when the available inline size cannot support two cards.
- Card actions and homepage buttons have a minimum `2.75rem` target height and visible focus.
- The Reaction Time response surface uses a fluid minimum height and never relies on hover. Its status, control, and results remain in document order at every supported width.
- No component may cause horizontal overflow at a `320px` viewport or equivalent 400% reflow. Query pagination may wrap rather than clip.
