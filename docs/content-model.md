# Content model

## Status

The initial content architecture is implemented by Cogpace Core. The `cogpace_game` post type, shared `cogpace_cognitive_domain` taxonomy, and approved game metadata are registered and REST-enabled.

Editorial articles use the core WordPress `post` type and follow the site-owner
responsibility, evidence, review, accessibility, update, and medical-claim
requirements in `docs/content-standards.md`.

## Initial model

| Object | WordPress representation | Owner | Purpose |
| --- | --- | --- |
| Blog | Core `post` | Theme for presentation; WordPress for editorial authoring | Cognitive education blogs, explainers, and evidence-aware references. |
| Cognitive game | `cogpace_game` custom post type | Cogpace Core plugin | Public catalogue and editorial record for each playable cognitive game. |
| Cognitive domain | `cogpace_cognitive_domain` shared taxonomy | Cogpace Core plugin | Connect blogs and games by the cognitive function they discuss or exercise. |

There is no separate Training, Research, Exercise, Assessment, or CVI object in the initial release.

### Blog

- Use standard WordPress posts and the existing editorial workflow.
- Use the shared Cognitive Domain taxonomy only when an article has a meaningful relationship to a game or cognitive function.
- Use WordPress categories and tags only for editorial organization; do not create a dedicated Research section.
- Each game-related article may link to a relevant cognitive game, but this relationship must be editorially justified and must not make clinical claims.

### Cognitive game

- The custom post type is public, REST-enabled, and archive-enabled at `/practise/`.
- Each game has a unique stable internal game key, title, short description, instructions, accessibility notes, and an optional evidence/rationale reference. Implemented keys are `focus-grid`, `maze-navigator`, `reaction-time`, `rule-switch`, `true-or-false`, and `sequence-recall`.
- Cognitive Domain is registered as a shared non-hierarchical taxonomy. Initial terms are added only with reviewed game/article content.
- Cogpace Core owns the game runtime contract and any future metadata registration; the theme only renders public contracts.
- The initial release stores no account, score, or personal performance data. Any future persistence requires an explicit privacy, retention, and consent decision.

### Cognitive domain

- The taxonomy is shared between Blog posts and Cognitive Games.
- Terms remain editorial records rather than plugin fixtures. The first published game uses the **Attention** term without implying a diagnosis.
- Terms describe cognitive functions (for example, attention or working memory), not diagnoses or medical outcomes.

## Relationship rules

- A Blog may relate to zero or more Cognitive Domains.
- A Cognitive Game must relate to one or more Cognitive Domains.
- Blogs and games are connected through shared Cognitive Domain terms; do not introduce a bespoke relationship table in the initial release.
- Relationship labels describe educational relevance or practice focus, never a diagnosis, treatment, cure, or guaranteed improvement.

## Modeling rules

- Prefer core posts, pages, users, terms, and media when they express the need.
- Add a custom post type only for a distinct lifecycle, capability model, or archive/query requirement.
- Use taxonomies for shared classification and registered metadata for structured attributes.
- Register every public post type, taxonomy, and meta field with capability, REST, sanitization, and authorization behavior.
- Never use serialized post meta as a substitute for a queryable relational model without documenting the trade-off.

## Implemented game records

| Field | Contract |
| --- | --- |
| Identifier | Core post ID plus unique `cogpace_game_key`; implemented keys are `focus-grid`, `maze-navigator`, `reaction-time`, `rule-switch`, `true-or-false`, and `sequence-recall` |
| Title and instructions | Core title, excerpt, and block editor content; sanitized and revisioned by WordPress |
| Cognitive relationship | One or more `cogpace_cognitive_domain` terms when editorially approved |
| Accessibility notes | Single string meta field `cogpace_accessibility_notes`, sanitized with `sanitize_textarea_field` |
| Evidence reference | Optional URL meta field `cogpace_evidence_reference`, sanitized with `esc_url_raw` |
| Archive/query | Public `/practise/` archive; normal `WP_Query` and REST post-type queries |
| Ownership | Users with core post-editing capabilities; metadata REST writes require `edit_posts` |
| Visibility | Public published records are queryable; drafts follow WordPress capability checks |
| Deletion | Uses the WordPress Trash/permanent-deletion lifecycle and does not delete with an author account |
| Privacy and retention | The content record contains no player data. Gameplay results are memory-only and disappear on reload/navigation |
| Export and migration | Core WordPress export covers posts, terms, content, and registered metadata; game keys must remain stable |

The `cogpace/focus-grid`, `cogpace/maze-navigator`, `cogpace/reaction-time`, `cogpace/rule-switch`, `cogpace/true-or-false`, and `cogpace/sequence-recall` dynamic blocks are the approved runtime entries. Cogpace Core renders their semantic HTML and conditionally loads dependency-free view scripts. The theme may place these blocks but does not own game rules, question content, scoring, sequence generation, navigation state, or timing.

## Deferred model decisions

- Additional Cognitive Domain terms and any future hierarchy change.
- Persistent game scores, analytics, consent, and retention.
- Separate objects for exercises, training programs, assessments, and research material.

## Required record for each model

| Field | Description |
| --- | --- |
| Identifier | Stable slug and text domain |
| Purpose | User and business outcome |
| Ownership | Who may create, change, publish, and delete it |
| Fields | Type, validation, default, visibility, and migration strategy |
| Relationships | Cardinality, query needs, and deletion behavior |
| API | REST/editor exposure and permissions |
| Retention | Export, archival, and deletion policy |
