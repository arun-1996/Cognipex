# FUTURE_ACTIONS.md

## Purpose

This document defines the long-term development roadmap for the Cognipex platform.

## Product Statement

Cognipex is an accessible, evidence-led cognitive wellness and learning platform for general audiences and people with cognitive challenges or impairments. It connects learning content, interactive practice, training, and progress-oriented experiences across the pillars **Learn**, **Play**, **Track**, and **Improve**.

The core experience combines blogs about cognition, explanations of how individual games exercise particular cognitive functions, and simple browser-based cognitive games. The initial revenue model is advertising.

Cognipex provides educational and practice experiences. It must not imply diagnosis, treatment, cure, or a guaranteed improvement in cognitive function without approved legal and clinical review.

This roadmap is the canonical implementation queue. Update its status as each approved milestone is completed.

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
- [ ] Define a motion policy before introducing animated interfaces.
- [ ] Define component-specific responsive behavior when components are implemented.

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
- [ ] Define the approved header layout and navigation behavior.
- [ ] Define the footer information architecture.
- [ ] Define the main-content layout variants.
- [ ] Decide whether a sidebar is required; do not scaffold one by default.

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

- Home
- Single Post
- Archive
- Search
- Page
- 404

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

---

# Phase 2 — Content Architecture

Define the platform's core content types.

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

---

# Phase 3 — Homepage

Design and build one exceptional homepage.

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

---

# Phase 4 — First Game

Build a single, polished cognitive game.

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

---

# Phase 5 — First Article

Publish one complete article.

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

Do not begin the remaining four games or scale article production until the first game and first article have passed the validation gate for accessibility, performance, editorial quality, and user value.

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
