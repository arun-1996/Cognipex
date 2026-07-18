# WordPress Block Theme Design-System Boilerplate

Use this as a repeatable brief for establishing a minimal, production-ready design system in a Full Site Editing WordPress block theme.

## Copyable request

```text
Build the design system for the [THEME NAME] Full Site Editing WordPress block theme.

Put all design-system configuration in theme.json.

Create:
- An accessible, semantic color palette
- System-font typography and a fluid type scale
- A mobile-first fluid spacing scale
- Border-radius tokens
- Shadow presets
- Global button styles
- Card design tokens for future components

Constraints:
- Do not create block patterns, pages, templates, or components.
- Do not add custom CSS or JavaScript.
- Use no externally hosted fonts or assets.
- Keep the palette and typography accessible and performance-focused.
- Do not enable arbitrary custom editor values when a curated token scale is available.
- Preserve WordPress Coding Standards and valid theme.json syntax.

Use these project inputs:
- Theme name: [THEME NAME]
- Theme slug: [THEME SLUG]
- Brand color: [HEX VALUE]
- Accent color: [HEX VALUE]
- Content width: [VALUE]
- Wide width: [VALUE]
```

## Required token model

| Area | Minimum token set | Notes |
| --- | --- | --- |
| Colors | canvas, surface, text, text-muted, brand, brand-strong, accent, border | Check text/background contrast before release. |
| Typography | system sans, optional system mono, small through 2XL sizes | Prefer local system stacks; use fluid sizes for display scales. |
| Spacing | 2XS through 2XL | Use `rem` and fluid `clamp()` values where useful. |
| Radius | none, small, medium, large, full | Store as `settings.custom` values. |
| Shadows | small, medium, large | Use restrained opacity and neutral color. |
| Buttons | background, text, radius, padding, type | Define as a global `styles.elements.button` style. |
| Cards | background, border, width, padding, radius, shadow | Define tokens only; do not style every Group block as a card. |

## Implementation checklist

- [ ] Update only `<theme>/theme.json`.
- [ ] Keep `$schema` and `version` compatible with the target WordPress release.
- [ ] Define palette, type, spacing, and shadow presets under `settings`.
- [ ] Disable unrestricted custom color, gradient, and font-size controls when the product requires a curated system.
- [ ] Store radius and card values under `settings.custom` so they emit reusable CSS custom properties.
- [ ] Apply only global element styles for buttons, links, and headings.
- [ ] Do not create CSS, JavaScript, patterns, pages, or block markup.
- [ ] Validate JSON with `node -e "JSON.parse(require('fs').readFileSync('<theme>/theme.json', 'utf8'))"`.
- [ ] Verify that all foreground/background color combinations meet the agreed accessibility target (normally WCAG 2.2 AA).

## Decisions to make before reuse

- Confirm the brand palette and whether it is legally approved.
- Confirm the minimum supported WordPress release and `theme.json` schema version.
- Confirm the audience’s default font and language requirements.
- Confirm content and wide layout widths from real content needs.
- Confirm whether editor authors may use values outside the curated token set.

