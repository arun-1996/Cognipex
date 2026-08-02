# FUTURE_ACTIONS.md

## Purpose

This document defines the long-term development roadmap for the Cogpace platform.

## Product Statement

Cogpace is an accessible, evidence-led cognitive wellness and learning platform for general audiences and people with cognitive challenges or impairments. It connects learning content, interactive practice, training, and progress-oriented experiences across the pillars **Learn**, **Play**, **Track**, and **Improve**.

The core experience combines blogs about cognition, explanations of how individual games exercise particular cognitive functions, and simple browser-based cognitive games. The initial revenue model is advertising.

Cogpace provides educational and practice experiences. It must not imply diagnosis, treatment, cure, or a guaranteed improvement in cognitive function without approved legal and clinical review.

This roadmap is the canonical implementation queue. Update its status as each approved milestone is completed.

Each unfinished action includes a **Codex prompt** immediately after its scope. Copy that prompt into a new Codex task when the action is approved. Replace bracketed placeholders before implementation.

Before starting any new task, the AI agent should:

1. Read `AGENTS.md`.
2. Read this roadmap.
3. Determine the next unfinished milestone.
4. Confirm the implementation plan before writing code.
5. Implement only the approved scope.
6. Avoid skipping ahead unless explicitly instructed.

---

# Guiding Principle

**Build the foundation before building features.**

The project should prioritize:

- Maintainability
- Performance
- Accessibility
- Reusability
- Scalability

Never implement features simply because they are possible.

---

# Phase 1 — Foundation

**Goal:** Create a robust design system and site structure.

## 1. Design System

### Objective

Create a complete design language using `theme.json`.

### Tasks

- [x] Define color palette
- [x] Define typography scale
- [x] Define spacing scale
- [x] Define border radius
- [x] Define shadows
- [x] Define container widths
- [x] Define global button styles and card tokens
- [x] Define a motion policy before introducing animated interfaces.

**Codex prompt — Motion policy**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, and the existing design-system documentation. Define and document a mobile-first motion policy for Cogpace before adding animated interfaces. Cover allowed motion, duration and easing tokens, reduced-motion behavior, interaction feedback, accessibility constraints, and performance limits. Keep `theme.json` as the source of truth where WordPress supports the required tokens, use scoped CSS only where necessary, and do not introduce animations or unrelated components. Update the relevant file in `wp-content/docs/` and `CHANGELOG.md` if the change is externally relevant. Run all applicable project checks and report the files changed, decisions made, and check results.

- [x] Define component-specific responsive behavior for implemented components.
  - [x] Site header responsive behavior.
  - [x] Homepage hero, feature grid, and content cards.
  - [x] Game catalogue, game cards, and Reaction Time surface.

**Codex prompt — Component responsive behavior**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, `wp-content/docs/design-system.md`, and the implementation of the approved component `[COMPONENT_NAME]`. Define and implement only that component's mobile-first responsive behavior. Prefer fluid `theme.json` tokens, add the fewest scoped breakpoints necessary, preserve semantic markup and keyboard usability, and test narrow, medium, wide, zoomed, and reflow layouts. Do not create a global breakpoint system speculatively. Document the component contract in `wp-content/docs/`, update `CHANGELOG.md` when externally relevant, run all applicable lint and format checks, and report the responsive decisions and verification results.

### Requirements

- Minimal
- Premium
- Modern
- Accessible
- Mobile-first
- Near-black canvas, layered dark surfaces, off-white text, and restrained white-tinted shadows

**Deliverable**

`theme.json` is the source of truth for design tokens and global element styles. WordPress does not provide a native `theme.json` contract for responsive breakpoints or runtime animation behavior: use fluid tokens first, then add scoped CSS only when an approved component needs a breakpoint or motion behavior.

---

## 2. Global Layout

Build reusable site layout through Full Site Editing templates and template parts.

### Tasks

- [x] Create minimal header, footer, and fallback main-content scaffolding.
- [x] Define the approved header layout and navigation behavior.
- [x] Define the footer information architecture.
- [x] Define the initial main-content layout.
- [x] Decide that no sidebar is required for the initial release.

The approved layout is documented in `docs/information-architecture.md`. Do not add navigation items until their corresponding routes are ready to publish.

---

## 3. Information Architecture

Define the site's navigation and content hierarchy.

Initial structure:

- Home
- Blogs
- Practise
- About

Focus on structure, not content.

**Status:** The initial Information Architecture record is defined in `docs/information-architecture.md`. Do not create pages as part of this milestone.

Initial section responsibilities:

- **Blogs** — Cognitive education blogs and explainers at `/blog/`.
- **Practise** — The interactive cognitive-game catalogue at `/practise/`; this is the initial training experience. Use “Cognitive Games” as the catalogue page heading.

Evidence-aware references remain within relevant blog articles. There is no separate Research section at launch.

Before creating navigation or pages, record the purpose, canonical URL, primary audience, and source content type for each section.

Use inclusive language in public-facing content: refer to **general audiences** and **people with cognitive challenges or impairments**. Do not frame users as “normal” or “challenged”.

---

## 4. Theme Templates

Create only the essential Full Site Editing templates.

Required:

- [x] Home and Blog index
- [x] Single Post
- [x] Archive
- [x] Search
- [x] Page
- [x] 404
- [x] Cognitive Game archive and single-game templates

Keep templates lightweight.

---

## 5. Block Patterns

Create reusable patterns instead of page-specific layouts.

Examples:

- Hero
- Section Header
- Article Card
- Game Card
- Feature Grid
- CTA
- Newsletter
- Statistics
- Research Card

Patterns should be composable and reusable.

**Status:** Hero, Section Header, Article Card, Game Card, Feature Grid, CTA, Statistics, and Research Card patterns are implemented with core blocks. Newsletter remains intentionally deferred pending its provider, consent, privacy, retention, and ownership decisions.

**Codex prompt — Block patterns**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, the active block theme, and the design-system and information-architecture documentation. Audit existing patterns, then implement the next approved reusable block pattern: `[PATTERN_NAME]`. Use core blocks and existing design tokens wherever possible; keep markup semantic, accessible, mobile-first, localization-ready, and free of page-specific content or business logic. Register the pattern in the theme using the project's existing conventions, add only scoped styling that cannot be expressed through `theme.json`, and do not implement unapproved routes or features. Document any new architectural contract, update `CHANGELOG.md` if externally relevant, run applicable checks, and report changed files plus visual and accessibility verification.

---

# Phase 2 — Content Architecture

Define the platform's core content types.

**Status:** The initial model is implemented and documented in `docs/content-model.md`. Cogpace Core registers the `cogpace_game` post type, `/practise/` archive, shared Cognitive Domain taxonomy, sanitized REST-visible metadata, and three approved game runtimes. Persistent scores, analytics, and additional content objects remain deferred.

Planned content:

- Articles
- Games

Deferred until the core experience is validated:

- Exercises as a separate object
- Research papers as a separate library
- Training programs
- Assessments

Think in terms of business objects rather than pages.

## Required decision record

Before registering any content type, document the following in `docs/content-model.md`:

- Whether the object uses a core post type or a custom post type.
- Stable identifier, fields, taxonomies, relationships, and archive/query needs.
- Ownership, capabilities, REST/editor visibility, validation, and deletion behavior.
- Privacy, retention, export, and migration requirements.

Initially, articles are the editorial content model. Games are the interactive practice model; decide their implementation form before registration. Research is represented through lightweight article content and references, not a separate research-paper model.

For each game, document the cognitive function it is intended to exercise, the supporting evidence or rationale, and the associated educational content. Do not present these relationships as clinical claims.

**Codex prompt — Content architecture**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, `wp-content/docs/content-model.md`, and the Cogpace Core plugin. Complete the next approved content-architecture action: `[ACTION]`. Before code changes, record the object type, stable identifier, fields, relationships, archive and query needs, ownership, capabilities, REST/editor visibility, validation, deletion, privacy, retention, export, and migration behavior. Keep business rules independent of WordPress hooks where practical and use WordPress APIs for registration, permissions, sanitization, escaping, and queries. Do not introduce a post type, taxonomy, REST route, dependency, or build step without documenting the decision in `wp-content/docs/`. Avoid clinical claims. Update the roadmap and changelog as appropriate, run applicable checks, and summarize decisions, migrations, and test results.

---

# Phase 3 — Homepage

Design and build one exceptional homepage.

**Status:** The dedicated homepage is implemented with reusable hero and feature-grid patterns plus a one-item Featured Practice query for the published Reaction Time game. Article, newsletter, and advertising sections remain absent until their content and operational requirements are approved.

Suggested sections:

- Hero
- Featured Games
- Featured Articles
- Cognitive Domains
- Benefits
- Newsletter
- Footer

The homepage should demonstrate the platform's quality and establish the visual identity.

Do not implement the newsletter section until its provider, consent language, privacy policy, and data ownership are approved. It may remain absent rather than use a non-functional form.

## Advertising constraint

Advertising is the initial revenue model. Before integrating an ad provider, document the provider, consent requirements, privacy policy, data-sharing implications, accessibility impact, and performance budget. Ads must not interrupt gameplay, obscure controls, create layout shift around interactive content, or appear in accessibility-critical flows.

**Codex prompt — Homepage**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, and the design-system, information-architecture, content-model, and branding documentation. Design and implement the Cogpace homepage using reusable Full Site Editing templates, template parts, and approved block patterns. Include only sections supported by published content and approved routes; omit the newsletter until its provider, consent language, privacy policy, and data ownership are approved. Keep the experience premium, minimal, mobile-first, fast, and accessible, with no unsupported cognitive or medical claims. If ads are in scope, first document provider, consent, privacy, data sharing, accessibility, and performance decisions, and prevent layout shift or interference with gameplay. Verify responsive layouts, keyboard use, focus visibility, contrast, reduced motion, and performance. Update relevant documentation, `CHANGELOG.md`, and this roadmap, run applicable checks, and report results.

---

# Phase 4 — First Game

Build a single, polished cognitive game.

**Status:** The Reaction Time code milestone is implemented with a server-rendered dynamic block, session-only results, five trials, keyboard/touch/pointer support, persistent status text, false-start recovery, tab-visibility reset, dedicated templates, and documented privacy/accessibility/performance contracts. True or False and Sequence Recall were subsequently approved as small follow-on games and reuse the validated block boundary without adding persistence, an API, or a dependency. Broader game expansion still requires real-user product-value validation.

Recommended first game:

- Reaction Time

Requirements:

- Responsive
- Fast
- Accessible
- Reusable architecture
- Performance-focused

Do not build multiple games before validating the architecture.

## Required implementation decision

Before building the game, decide and document:

- The rendering boundary between the theme, the core plugin, and any necessary JavaScript.
- Whether anonymous scores are stored, and the data-retention and privacy policy if they are.
- Keyboard-only interaction, focus behavior, reduced-motion behavior, and the timed-interaction accessibility model.
- Performance budget and supported-device test matrix.
- Rules that prevent advertising from interrupting or degrading gameplay.

After release, validate the game’s usability, accessibility, performance, and product value before approving a second game.

## Approved second game — True or False

**Status:** The code milestone is implemented as a ten-question, untimed activity with shuffled questions, immediate explanations, session-only scoring, keyboard/touch/pointer support, and documented content, privacy, accessibility, performance, and advertising boundaries. Its editorial `cogpace_game` record is published at `/practise/true-or-false/` with the stable game key, Reasoning domain, instructions, excerpt, and accessibility notes.

The stable game key is `true-or-false`. Cogpace Core owns its question bank and runtime, while the block theme consumes the dynamic block through the shared single-game template.

## Approved third game — Sequence Recall

**Status:** The code milestone is implemented as a five-round sequence-memory activity with three-to-seven-item progression, user-initiated playback and replay, untimed responses, session-only results, keyboard shortcuts, touch/pointer support, tab-visibility recovery, and documented privacy, accessibility, performance, and advertising boundaries. Its editorial `cogpace_game` record is published at `/practise/sequence-recall/` with the stable game key, Working Memory domain, instructions, excerpt, and accessibility notes.

The stable game key is `sequence-recall`. Cogpace Core owns its random sequence generation and runtime, while the block theme consumes the dynamic block through the shared single-game template.

**Codex prompt — First game: Reaction Time**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, `wp-content/docs/content-model.md`, `wp-content/docs/architecture.md`, and the existing theme and Cogpace Core plugin. First document the approved rendering boundary, score-storage and retention policy, privacy behavior, keyboard and focus model, reduced-motion behavior, timed-interaction accessibility, performance budget, supported-device matrix, advertising constraints, cognitive rationale, and related educational content for the Reaction Time game. Then implement one polished, responsive, accessible Reaction Time game using reusable architecture and WordPress APIs. Treat all input as untrusted, do not store anonymous scores unless explicitly approved, and do not imply diagnosis, treatment, or guaranteed improvement. Add automated tests where supported and manually verify keyboard-only use, touch, zoom/reflow, reduced motion, timing behavior, error recovery, and performance. Update documentation, `CHANGELOG.md`, and this roadmap, run all applicable checks, and report validation evidence. Do not build a second game.

---

# Phase 5 — First Article

Publish one complete article.

**Status:** The ownership, evidence, review, update, accessibility, and medical-claim requirements are documented in `docs/editorial-policy.md`. “What Is Working Memory?” is prepared in WordPress as draft post 23 with five peer-reviewed references and explicit limits on training and assessment claims. It remains unpublished pending named-human evidence, editorial, and accessibility approval. The approved Sequence Recall game now supplies a related practice option; connecting it to the draft remains part of editorial review.

Suggested topic:

> What is Working Memory?

Include:

- Introduction
- Scientific explanation
- Practical applications
- Related cognitive game
- Related articles
- References

Each article should connect learning with interactive practice.

Before publication, define the editorial owner, evidence and citation standard, review process, update cadence, and medical-claim boundary. Content must not imply diagnosis or treatment without an approved legal and clinical review process.

**Codex prompt — First article: Working Memory**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, and the content-model, information-architecture, and branding documentation. Define and document the editorial owner, evidence and citation standard, review workflow, update cadence, accessibility requirements, and medical-claim boundary for Cogpace articles. Then draft and prepare the first article, “What Is Working Memory?”, with an introduction, plain-language scientific explanation, practical applications, an approved related cognitive game, related articles, and authoritative references. Clearly distinguish evidence from inference, avoid diagnosis, treatment, cure, and guaranteed-improvement claims, and do not invent unavailable related content. Use semantic, accessible WordPress blocks and the existing article template. Complete editorial and accessibility review before publication, update documentation, `CHANGELOG.md`, and this roadmap as appropriate, and report sources, review status, and checks. Do not publish without explicit approval if publication changes the live site.

---

# Not Yet

The following features are intentionally postponed.

Do **not** implement unless explicitly requested.

- Authentication
- User Dashboard
- AI Features
- Leaderboards
- Payments
- Premium Membership
- Mobile App
- Achievements
- Social Features

Focus on validating the core experience first.

---

# Long-Term Platform Structure

The platform should eventually revolve around four pillars:

- Learn
- Play
- Track
- Improve

Every future feature should clearly support one or more of these pillars.

---

# Initial MVP

The first public version should include:

- A polished homepage
- Five cognitive games
- Twenty evidence-based articles
- Excellent UI/UX
- Fast loading performance
- Strong accessibility
- Mobile-first design

The objective is to validate the product before expanding into advanced functionality.

## Scaling Gate

Do not begin the remaining two MVP games or scale article production until the implemented games and first article have passed the validation gate for accessibility, performance, editorial quality, and user value.

**Codex prompt — MVP scaling gate**

> Read `AGENTS.md`, `wp-content/FUTURE_ACTIONS.md`, and all validation records for the first game and first article. Audit the first game and article against documented accessibility, performance, editorial-quality, and user-value criteria. Produce an evidence-based go/no-go decision for scaling toward five games and twenty articles, listing failures, risks, and required remediation. Do not implement additional games or articles during this audit. If every gate passes and expansion is explicitly approved, propose a sequenced implementation plan that reuses the validated architecture and preserves the advertising, privacy, accessibility, performance, and medical-claim constraints. Record the decision in `wp-content/docs/`, update this roadmap if status changes, run applicable checks, and report the evidence and recommendation.

---

# AI Agent Instructions

Before implementing any task:

1. Read `AGENTS.md`.
2. Read `FUTURE_ACTIONS.md`.
3. Identify the next incomplete milestone.
4. Produce a short implementation plan.
5. Wait for approval if the scope is unclear.
6. Keep commits focused on a single feature.
7. Do not implement future phases early.
8. Prefer maintainability over speed.
9. Reuse existing components whenever possible.
10. Update this roadmap when a milestone is completed or significantly changes.

---

# Definition of Done

A milestone is complete only when:

- Code follows project standards.
- Accessibility requirements are met.
- Performance impact is acceptable.
- Documentation is updated.
- No unnecessary complexity has been introduced.
- The implementation is reusable and maintainable.
