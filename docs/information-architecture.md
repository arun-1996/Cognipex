# Information architecture

## Status

The initial navigation structure is approved. This document defines routes and ownership only; it does not create WordPress pages, menus, templates, or content.

## Primary navigation

| Order | Section | Canonical URL | Purpose | Primary audience | Source |
| --- | --- | --- | --- | --- | --- |
| 1 | Home | `/` | Introduce Cogpace and guide visitors to its core experiences. | All visitors | Block theme `front-page.html`. |
| 2 | Blogs | `/blog/` | Publish cognitive education blogs, explainers, and evidence-aware references. | Visitors learning about cognition. | WordPress post archive, to be configured later. |
| 3 | Explore Human Brain | `/explore-human-brain/` | Offer an interactive anatomical Three.js brain experience. | Visitors exploring cognition visually. | WordPress page with the block-theme `page-explore-human-brain.html` template. |
| 4 | Practise | `/practise/` | Offer the cognitive-game catalogue and the initial interactive-practice experience. | Visitors seeking cognitive practice. | Cogpace Core `cogpace_game` archive. |
| 5 | About | `/about/` | Explain Cogpace, its purpose, and its editorial approach. | Visitors evaluating the platform. | WordPress page. |

## Navigation rules

- Use the primary-navigation order shown above.
- Use **Practise** for navigation and `/practise/` for its canonical URL; use **Cognitive Games** as the catalogue page heading.
- Keep evidence and references within relevant blog articles; do not create a separate Research section at launch.
- Do not create navigation items until the corresponding route and source are ready to publish.

The theme header exposes Home, Blog, Practise, and About. Explore Human Brain remains available through the homepage without occupying global navigation space.

## Footer information routes

| Page | Canonical URL | Purpose |
| --- | --- | --- |
| Content standards | `/content-standards/` | Explain evidence, independent site-owner responsibility, maintenance, and medical-claim standards. |
| Accessibility | `/accessibility/` | State the accessibility target, implementation approach, and ongoing-review status. |
| Privacy notice | `/privacy/` | Explain limited technical processing and the session-only activity-data model. |
| Terms and disclaimer | `/terms/` | Set educational-use, performance, responsible-use, and availability boundaries. |
| Cookie information | `/cookies/` | Explain that the public site currently uses no optional cookies or consent categories. |

These are core WordPress pages provisioned by the product plugin. A versioned, idempotent migration creates missing pages, preserves non-empty existing editorial content, publishes the routes, and assigns the Privacy notice as the WordPress privacy-policy page. No custom post type or custom REST route is introduced.

The retired `/editorial-policy/` route permanently redirects to
`/content-standards/` for backward compatibility.

## Approved global layout

| Area | Approved initial behavior |
| --- | --- |
| Header | Cogpace site title or logo links to Home. Primary navigation is added only when its routes are ready to publish. |
| Main | A single constrained content column. |
| Sidebar | None. |
| Footer | Brand statement, trust boundary, live Explore links, Standards links, privacy/legal links, and copyright. |

Footer links must point only to published routes. Newsletter forms, social links, and a public contact route remain absent until their operational requirements and content are approved.

## Deferred decisions

- A fact-checked homepage trust strip remains deferred until its final metrics and wording are approved.
- Topic shortcuts remain deferred until the cognitive-topic taxonomy and destination pages are approved.

## Homepage implementation

The block theme's `front-page.html` is a dedicated product homepage and must not render the current post through the Post Content block. Its current scope is an introductory hero, actionable Blog/Practise pathways, a three-step product explanation, a featured five-minute activity, article and game queries, and an editorial-trust panel. The interactive Three.js model belongs only to `/explore-human-brain/`; the blog remains owned by the posts index at `/blog/`.

Do not add article queries, newsletter forms, advertising, or links to unpublished routes until their content and operational requirements are approved.
