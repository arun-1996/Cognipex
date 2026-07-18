# Architecture

## Status

This is a foundation, not an implementation. Product identifiers and the first capability are intentionally undecided.

## Boundary

WordPress core remains third-party platform code. Product code must live under `wp-content/`, with this default separation:

| Concern | Location | Responsibility |
| --- | --- | --- |
| Product behavior | `wp-content/plugins/<product-slug>/` | Domain logic, data registration, integrations, APIs |
| Presentation | `wp-content/themes/<product-slug>/` | Block templates, styles, patterns, user-facing rendering |
| Runtime content | `wp-content/uploads/` | Unversioned media; never product source |

The product plugin must not depend on the product theme. The theme may consume public plugin contracts only.

## Principles

- Use WordPress-native capabilities first: blocks, settings, REST, roles, cron, and metadata.
- Keep mutable configuration in environment-aware WordPress configuration or settings, never source control secrets.
- Make dependencies explicit with Composer and npm lockfiles.
- Version and document every public contract before it is consumed.
- Design for accessibility, internationalization, privacy, and secure defaults from the first feature.

## Decisions pending

- Product slug, text domain, and licensing.
- Supported WordPress/PHP/database/browser matrix.
- Deployment topology and configuration/secrets provider.
- Whether a separate front-end application is necessary.

