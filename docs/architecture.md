# Architecture

`headless-theme` is a small WordPress theme intended for headless WordPress setups.

```text
WordPress theme bootstrap
  -> frontend redirect logic
  -> admin settings
  -> REST API filters
  -> external frontend consumes WordPress content APIs
```

## Components

- `functions.php` loads theme support and includes the theme modules.
- `inc/frontend-redirect.php` controls frontend redirect behavior.
- `inc/admin-settings.php` owns theme settings in WordPress admin.
- `inc/rest-filters.php` adjusts REST API behavior.

## Trust Boundaries

- WordPress admin and hosting credentials stay outside Git.
- Deployment credentials stay outside GitHub issues and pull requests.
- CI uses GitHub-hosted runners only for this Phase 1 pilot.