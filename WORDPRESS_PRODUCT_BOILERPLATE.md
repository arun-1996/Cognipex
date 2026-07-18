# WordPress Product Boilerplate

Reusable blueprint for a long-lived WordPress product using a Full Site Editing block theme and a companion core plugin. It establishes structure and quality gates only; it does not prescribe product features.

## Copyable request

```text
You are a senior WordPress software architect.

Bootstrap this repository as a long-term WordPress product named [PRODUCT NAME].
Create infrastructure only. Do not implement product features, pages, block patterns, custom content types, routes, or integrations.

Create root project infrastructure:
- README.md
- AGENTS.md
- ROADMAP.md
- CHANGELOG.md
- TODO.md
- .gitignore
- .editorconfig
- phpcs.xml
- composer.json
- package.json
- docs/architecture.md
- docs/design-system.md
- docs/content-model.md
- docs/api.md
- docs/branding.md

Create a minimal Full Site Editing block theme:
- Location: wp-content/themes/[THEME SLUG]/
- Required: style.css, theme.json, templates/index.html, parts/header.html, parts/footer.html
- No custom CSS rules, JavaScript, pages, or block patterns
- Mobile-first, accessible, performance-focused, and WordPress Coding Standards compliant

Create a companion core plugin:
- Location: wp-content/plugins/[PLUGIN SLUG]/
- A valid plugin entry point and PSR-4 namespace [VENDOR]\\Core\\
- Empty source boundaries for Admin, Domain, and Infrastructure
- A languages directory
- No registered hooks, routes, settings, content types, or features

Build the initial design system in the theme's theme.json only:
- Accessible semantic colors
- System-font typography and fluid type scale
- Mobile-first spacing scale
- Border-radius and shadow tokens
- Global button styles
- Card tokens only; do not build card components

Ask for clarification only when a product-specific choice would materially change the architecture. Record unresolved decisions rather than inventing product behavior.
```

## Target layout

```text
.
├── docs/
│   ├── api.md
│   ├── architecture.md
│   ├── branding.md
│   ├── content-model.md
│   └── design-system.md
├── wp-content/
│   ├── plugins/
│   │   └── [plugin-slug]/
│   │       ├── languages/
│   │       ├── src/
│   │       │   ├── Admin/
│   │       │   ├── Domain/
│   │       │   └── Infrastructure/
│   │       └── [plugin-slug].php
│   └── themes/
│       └── [theme-slug]/
│           ├── parts/
│           │   ├── footer.html
│           │   └── header.html
│           ├── templates/
│           │   └── index.html
│           ├── style.css
│           └── theme.json
├── .editorconfig
├── .gitignore
├── AGENTS.md
├── CHANGELOG.md
├── README.md
├── ROADMAP.md
├── TODO.md
├── composer.json
├── package.json
└── phpcs.xml
```

## Foundation standards

| Concern | Baseline |
| --- | --- |
| Product boundary | Custom code stays in `wp-content/`; WordPress core is not modified. |
| Behavior | A plugin owns business logic, data registration, integrations, and public APIs. |
| Presentation | A block theme owns templates, template parts, styles, and patterns. |
| Dependency management | Composer manages PHP development tooling and PSR-4 autoloading; npm manages front-end development tooling. Commit lockfiles when dependencies are installed. |
| PHP quality | Use WordPress Coding Standards with PHPCompatibilityWP for the agreed PHP baseline. |
| Security | Use WordPress capabilities, nonces, sanitization, escaping, REST permission callbacks, and approved secret storage. |
| Performance | Prefer WordPress-native capabilities, system fonts, no unnecessary assets, and measured caching. |
| Accessibility | Target WCAG 2.2 AA, keyboard operation, visible focus, semantic landmarks, and reduced motion. |
| Documentation | Document architectural contracts before implementing a content model, API, integration, or dependency. |

## Theme rules

- `style.css` contains required theme metadata only until custom CSS is genuinely needed.
- `theme.json` is the source of truth for global design tokens and element styles.
- Use system font stacks and avoid remote font dependencies by default.
- Use `templates/index.html` as the required fallback template and template parts for reusable header/footer landmarks.
- Do not use a block pattern as a substitute for a template, or a template as a substitute for a product page.
- Keep card values as tokens in `settings.custom`; do not globally turn every Group block into a card.

## Plugin rules

- Give the plugin a stable slug, text domain, PHP namespace, and package name before releasing it.
- Use a PSR-4 mapping such as `[Vendor]\\Core\\` to `src/`.
- Keep source boundaries empty until a product requirement identifies ownership.
- Keep the entry file inert until there is an explicit bootstrap contract.
- Do not couple the plugin to a specific theme; publish intentional contracts instead.

## Required documentation

| File | Must answer |
| --- | --- |
| `README.md` | What this product is, runtime requirements, setup, and where custom code belongs. |
| `AGENTS.md` | Contribution boundaries, coding rules, checks, and documentation expectations. |
| `docs/architecture.md` | Product boundaries, dependency direction, principles, and pending decisions. |
| `docs/design-system.md` | Token model, accessibility standards, and design-system status. |
| `docs/content-model.md` | Rules and record template for post types, taxonomies, metadata, and retention. |
| `docs/api.md` | API versioning, authorization, validation, caching, and deprecation rules. |
| `docs/branding.md` | Approved brand assets and the items still awaiting approval. |
| `ROADMAP.md` | Current foundation work, next product-definition work, and later delivery readiness. |
| `CHANGELOG.md` | User-visible and release-relevant changes, using Keep a Changelog format. |
| `TODO.md` | Concrete unresolved ownership and platform decisions. |

## Decisions required before feature work

- Product name, slugs, text domains, licensing, and ownership.
- Minimum supported WordPress, PHP, database, and browser versions.
- Hosting topology, environment configuration, secrets, backup, and deployment ownership.
- First product capability, audience, success criteria, and data-retention requirements.
- Brand approval, localization policy, accessibility target, and analytics/privacy policy.
- CI checks, release process, monitoring, and incident response.

## Handoff checklist

- [ ] No WordPress core files were modified.
- [ ] The root docs and configuration files exist and contain no invented product features.
- [ ] The theme is limited to metadata, `theme.json`, fallback template, and essential parts.
- [ ] The plugin is namespaced but does not execute product behavior.
- [ ] `theme.json`, `composer.json`, and `package.json` parse successfully.
- [ ] Plugin PHP files pass `php -l`.
- [ ] Composer validates and configured lint commands are documented.
- [ ] Unresolved product decisions are clearly recorded for the next phase.

