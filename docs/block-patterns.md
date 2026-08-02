# Block patterns

## Status

The Cogpace block theme supplies reusable, localization-ready patterns built from core blocks. Patterns contain presentation and placeholder copy only; they do not register routes, query private data, or contain product behavior.

| Pattern | Slug | Intended use |
| --- | --- | --- |
| Product hero | `cogpace/hero` | Page-level introduction with one primary action |
| Section header | `cogpace/section-header` | Eyebrow, heading, and supporting copy |
| Article card | `cogpace/article-card` | Query-loop article summaries with image, date, title, and excerpt |
| Game card | `cogpace/game-card` | Query-loop cognitive-game summaries |
| Feature grid | `cogpace/feature-grid` | Responsive paired or repeated feature introductions |
| Call to action | `cogpace/cta` | One clear next step |
| Statistics | `cogpace/statistics` | Reviewed facts with surrounding source context |
| Research reference card | `cogpace/research-card` | Reviewed reference summary inside editorial content |
| Interactive brain experience | `cogpace/brain-experience` | Dedicated Explore Human Brain page with the progressively enhanced Three.js model |
| How Cogpace works | `cogpace/how-it-works` | Three-step homepage explanation connecting learning, practice, and reflection |
| Five-minute practice | `cogpace/five-minute-practice` | Prominent homepage entry point to a short featured activity |
| Editorial trust | `cogpace/editorial-trust` | Homepage evidence, medical-boundary, and privacy commitments |

The newsletter pattern remains intentionally absent until a provider, consent language, privacy policy, retention, and data owner are approved.

## Contract

- Patterns use the `cogpace` category and core blocks.
- Query-compatible cards may be placed inside a Post Template block and rely on inherited queries.
- Component classes are scoped with the `cogpace-` prefix and use `theme.json` tokens.
- The Article Card owns its image crop, content hierarchy, interactive elevation, and reduced-motion behavior.
- Homepage action patterns use implemented routes and factual product commitments; future metrics require approval before display.
- Placeholder statistics and references must be replaced and editorially reviewed before publication.
- Pattern PHP escapes translated placeholder strings. There is no page-specific business logic or JavaScript.
