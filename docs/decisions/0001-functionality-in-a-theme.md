# 0001: The theme carries functionality, and classic template functions do not apply

Date: 2026-10-29
Status: accepted (owner: Samiran Kakoty)

## Context

The WordPress theme standard says a theme controls presentation and that functionality belongs in a plugin; for a private or self-distributed theme a deviation is a recorded decision. It also lists template functions a classic theme must call (`wp_head()`, `body_class()`, `wp_footer()` and others).

This theme exists only so that a WordPress install used as a headless content backend has an active theme. It never renders a page.

## Decision

- The theme keeps two pieces of functionality: the frontend redirect (`inc/frontend-redirect.php`) and the filter that allows anonymous comments through the REST API (`inc/rest-filters.php`), which headless frontends use for comment forms.
- The classic template functions are not applicable. `index.php` renders nothing, because every frontend request is redirected, or, with no Frontend URL set, shows an empty page.
- WordPress.org distribution is out of scope (see `engineering-standards.yml`, distribution).

## Consequences

- Switching to another theme turns off the redirect and anonymous REST comments. No content or data is lost; the only stored value is the `headless_frontend_url` option.
- Sites that do not want anonymous REST comments must disable them with their own filter or a plugin.

## Rollback

Switch to any other theme; delete the `headless_frontend_url` option if wanted.
