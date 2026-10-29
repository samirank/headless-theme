# Repository Agent Policy

## Purpose

This repository participates in Samiran's software factory. GitHub issues, pull requests, checks, and approvals are the authoritative source of truth.

## Runtime

- PHP: 8.1 or newer recommended.
- Composer: used for metadata and validation.
- WordPress: 6.x or newer recommended.

## Required Commands

```sh
composer validate --strict --no-check-lock
find . -path './vendor' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
composer install && vendor/bin/phpunit
```

## File Map

- `functions.php`: theme bootstrap and includes.
- `inc/`: redirect, admin settings, and REST API filters.
- `style.css`: WordPress theme metadata.
- `.github/`: issue templates, PR template, workflows, Dependabot, and CODEOWNERS.
- `docs/`: architecture, runbook, and decisions.
- `tests/`: PHPUnit tests with WordPress stubs (`tests/bootstrap.php`); dev-only, not shipped.

## Required Behavior

- Work only on the linked issue.
- Initial repository bootstrap PRs may omit a linked issue when creating the issue templates/control-plane needed to make future issues factory-ready.
- Do not silently expand scope.
- Preserve backward compatibility unless the issue explicitly changes it.
- Add or update tests when behavior changes.
- Run the required commands before opening a PR.
- Never expose secrets.
- Never modify production data without the owner's explicit approval and a backup taken first.
- Do not merge, tag, release or deploy unless the owner explicitly approves that specific action in chat; required checks must pass first.
- Document assumptions.
- Stop and request human input when requirements conflict.

## Prohibited Changes

- Do not commit `.env`, tokens, private keys, dumps, logs, or secret-bearing artifacts.
- Do not change authentication, authorization, deployment, billing, infrastructure, database migrations, or secrets without explicit human approval.
- Do not use production credentials in tests.
- Do not remove committed `vendor/` content unless a scoped dependency-hygiene issue explicitly authorizes it.

## Deployment Rules

Document the deployment target, preview behavior, required approvals, and rollback method before production-impacting changes. Production deployment is not automatic in this phase.

## QA Evidence

User-visible frontend changes require screenshots or browser QA evidence when a preview or local run path exists.

## Definition Of Done

- Acceptance criteria are satisfied.
- Required checks pass.
- No new secret or high-severity vulnerability is introduced.
- User-visible changes include evidence.
- Rollback is described.
- PR links the issue, except for initial repository bootstrap PRs that create the issue templates/control-plane required for future issues.

<!-- engineering-standards:begin -->

## Engineering standards

This project follows https://github.com/samirank/engineering-standards pinned at `v1.8.0`. Before material work read its `AGENTS.md` at that ref and the standards it links, and verify anything freshness-sensitive against current official sources.

Project-specific architecture and approved pins live in `engineering-standards.yml` and the project docs; they govern product specifics. They never weaken the standard's security, credential, testing or human-approval rules. When the two conflict, stop and ask.

Before the first action on an external service (hosting, deploys, DNS, email, CI, a registry, an integration), report what you found for reaching it, confirm with the owner how to reach it and what will be created, and wait for approval. A platform default is not approval. See `standards/integration-interfaces.md`.

This block is a pointer, not the whole standard: read only the standards that apply to the task (run `adopt.py context` for the short list), and keep your own instruction files short (`standards/context-management.md`).

<!-- engineering-standards:end -->
