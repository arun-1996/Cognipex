# API

## Status

No custom REST route exists. Cogpace Core uses the standard WordPress REST representations for its public post type, taxonomy, and registered metadata.

## WordPress REST contracts

- `cogpace_game` is REST-visible through the core posts controller.
- `cogpace_cognitive_domain` is REST-visible through the core terms controller.
- `cogpace_game_key`, `cogpace_accessibility_notes`, and `cogpace_evidence_reference` are single string fields exposed through registered post meta. Writes require the ability to edit posts and use their documented sanitizers.
- The Reaction Time, True or False, and Sequence Recall runtimes do not send requests and create no API, analytics, or score-storage surface.

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
