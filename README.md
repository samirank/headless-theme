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
composer install && vendor/bin/phpunit
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

## Project Documents

- [AGENTS.md](AGENTS.md), [CONTRIBUTING.md](CONTRIBUTING.md), [SECURITY.md](SECURITY.md), [SUPPORT.md](SUPPORT.md), [CHANGELOG.md](CHANGELOG.md), [LICENSE](LICENSE)
- [Documentation map](docs/documentation-map.md), [data handling](docs/data-handling.md)
- Engineering standard: [engineering-standards.yml](engineering-standards.yml) pins `samirank/engineering-standards` v1.8.0.

## Licenses and credits

- Headless Theme: GPL-2.0-or-later ([LICENSE](LICENSE)).
- [Plugin Update Checker](https://github.com/YahnisElsts/plugin-update-checker) by Jānis Elsts, bundled in `vendor/`: MIT (GPL-compatible). It includes Parsedown by Emanuil Rusev: MIT.
- `screenshot.png`: generated on 2026-10-14 with Python Pillow (Georgia and Segoe UI Light rendered locally) by Claude Code, and approved by the owner. No third-party images.
- Decisions: [docs/decisions](docs/decisions/README.md).
