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
```

## File Map

- `functions.php`: theme bootstrap and includes.
- `inc/`: redirect, admin settings, and REST API filters.
- `style.css`: WordPress theme metadata.
- `.github/`: issue templates, PR template, workflows, Dependabot, and CODEOWNERS.
- `docs/`: architecture, runbook, and decisions.

## Required Behavior

- Work only on the linked issue.
- Do not silently expand scope.
- Preserve backward compatibility unless the issue explicitly changes it.
- Add or update tests when behavior changes.
- Run the required commands before opening a PR.
- Never expose secrets.
- Never modify production data.
- Do not merge or deploy.
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
- PR links the issue.