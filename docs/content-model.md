# Content model

## Status

No custom content model is defined yet. This document is the source of truth before registering any post type, taxonomy, metadata, or option.

## Modeling rules

- Prefer core posts, pages, users, terms, and media when they express the need.
- Add a custom post type only for a distinct lifecycle, capability model, or archive/query requirement.
- Use taxonomies for shared classification and registered metadata for structured attributes.
- Register every public post type, taxonomy, and meta field with capability, REST, sanitization, and authorization behavior.
- Never use serialized post meta as a substitute for a queryable relational model without documenting the trade-off.

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

