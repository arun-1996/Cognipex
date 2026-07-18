# API

## Status

No custom API surface exists.

## Contract rules

- Prefer existing WordPress APIs before creating a custom route.
- Namespace routes as `/<product-slug>/v1`; never use an unversioned public route.
- Define request validation, authorization, response schema, error shape, rate limits, caching, and deprecation plan before release.
- Require capability checks and use WordPress REST permission callbacks on every protected endpoint.
- Do not expose credentials, private metadata, drafts, personal data, or internal implementation details.
- Document every public route here when introduced, including examples and compatibility guarantees.

## Proposed route record

| Field | Description |
| --- | --- |
| Route | Method and versioned URI |
| Purpose | Consumer-facing behavior |
| Access | Authentication, capability, and nonce requirements |
| Input | Parameters, validation, and limits |
| Output | Schema, status codes, cache behavior |
| Lifecycle | Owner, introduced version, deprecation path |

