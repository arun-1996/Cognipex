# Architecture

## Status

Cogpace uses a coordinated `cogpace` block theme and `cogpace-core` product plugin. The implemented interactive capabilities are the Reaction Time, True or False, Sequence Recall, Rule Switch, Maze Navigator, and Focus Grid games.

## Boundary

WordPress core remains third-party platform code. Product code must live under `wp-content/`, with this default separation:

| Concern | Location | Responsibility |
| --- | --- | --- |
| Product behavior | `wp-content/plugins/<product-slug>/` | Domain logic, data registration, integrations, APIs |
| Presentation | `wp-content/themes/<product-slug>/` | Block templates, styles, patterns, user-facing rendering |
| Runtime content | `wp-content/uploads/` | Unversioned media; never product source |

The product plugin must not depend on the product theme. The theme may consume public plugin contracts only.

## Implemented identifiers and runtime baseline

| Concern | Decision |
| --- | --- |
| Product name | Cogpace (working name; legal review remains pending) |
| Theme slug and text domain | `cogpace` |
| Plugin slug and text domain | `cogpace-core` |
| WordPress baseline | 7.0 or later |
| PHP baseline | 8.2 or later |
| Front-end architecture | Server-rendered block theme with progressive, dependency-free JavaScript for approved interactive blocks |

## Explore Human Brain Three.js visual

- The dedicated Explore Human Brain page is presentation-only and therefore lives in the `cogpace` block theme rather than the product plugin.
- Three.js 0.160.0 and its GLTF loader utilities are pinned and vendored in `themes/cogpace/assets/js/`; the browser does not make a third-party CDN request.
- The anatomical mesh is the CC BY “Human Brain Model” by Johnson J, NIH 3D entry 3DPX-021160, vendored as `themes/cogpace/assets/models/human-brain.glb` and credited in the rendered section.
- The experience is progressively enhanced, loads only on `/explore-human-brain/`, has no persistence or API surface, supports pointer and keyboard rotation, and stops ambient animation when reduced motion is requested.

## Game rendering boundary

- Cogpace Core owns game content registration, metadata, domain rules, server-rendered game markup, scoped game assets, state, timing, and privacy behavior.
- The block theme owns the catalogue and single-game templates, layout, reusable cards, and global design tokens. It consumes the public `cogpace/focus-grid`, `cogpace/maze-navigator`, `cogpace/reaction-time`, `cogpace/rule-switch`, `cogpace/true-or-false`, and `cogpace/sequence-recall` block contracts and must not reproduce their behavior.
- WordPress owns editorial lifecycle, permissions, revisions, REST exposure, and canonical post URLs.
- Each game block is registered from metadata in its `blocks/<game-key>/block.json` directory. None of the blocks has a build step or third-party runtime dependency, and each `view.js` loads only when WordPress renders that block.
- The shared single-game template places all dynamic game blocks. Each block checks the current post's stable game key and renders only for the matching cognitive-game record.
- No custom REST route, score endpoint, browser storage, analytics event, account dependency, or theme-to-plugin callback is introduced.

## Public information pages

- Cogpace Core owns a versioned, idempotent content migration for the About, Content Standards, Accessibility, Privacy Notice, Terms & Disclaimer, and Cookie Information pages linked from the global footer.
- The migration uses core WordPress pages and options, preserves non-empty existing editorial content, and records a schema option after every route is available.
- The former `/editorial-policy/` route permanently redirects to `/content-standards/` so existing external links remain valid.
- The Privacy Notice is assigned through WordPress's native privacy-policy setting. No custom post type, taxonomy, REST route, dependency, or build step is introduced.
- The block theme owns the shared information-page presentation, structured global footer, and navigation links.

## Principles

- Use WordPress-native capabilities first: blocks, settings, REST, roles, cron, and metadata.
- Keep mutable configuration in environment-aware WordPress configuration or settings, never source control secrets.
- Make dependencies explicit with Composer and npm lockfiles.
- Version and document every public contract before it is consumed.
- Design for accessibility, internationalization, privacy, and secure defaults from the first feature.

## Decisions pending

- Legal product name, trademark status, and final licensing.
- Supported database versions and the final browser/device support matrix beyond the first-game test matrix.
- Deployment topology and configuration/secrets provider.
