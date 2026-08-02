# Headless Theme

A small WordPress theme for headless WordPress sites. The theme keeps WordPress available as a content backend while redirecting ordinary frontend requests and exposing controlled REST API behavior.

## Requirements

- WordPress 6.x or newer recommended.
- PHP 8.1 or newer recommended.
- Composer for validation and autoload checks.

## Local Setup

```sh
composer validate --strict --no-check-lock
find . -path './vendor' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
```

## Repository Layout

- `functions.php`: theme bootstrap and includes.
- `inc/`: redirect, admin settings, and REST API filters.
- `style.css`: WordPress theme metadata.
- `composer.json`: Composer package metadata and autoload configuration.
- `.github/`: issue templates, pull request template, workflows, Dependabot, and CODEOWNERS.
- `docs/`: architecture, runbook, and decisions.

## Factory Workflow

Use one issue, one branch, and one pull request. Pull requests must include test evidence, security impact, and rollback notes before merge.