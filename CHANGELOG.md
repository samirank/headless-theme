# Changelog

Written for users, in plain language. Versions follow semantic versioning.

## Unreleased

## 1.0.6 (2026-10-29)

### Changed
- The settings page text can now be translated.
- The theme declares where its updates come from (`Update URI`), so WordPress never mistakes another theme with the same name for an update.

### For developers
- Unit tests (PHPUnit) for the redirect, the settings save and the changelog page, run in CI.
- GitHub Actions pinned to commit SHAs; test files are kept out of the release zip.

## 1.0.5 (2026-10-14)

### Changed
- A simpler, cleaner theme screenshot.

## 1.0.4 (2026-10-13)

### Fixed
- "View version details" on an available update now shows this theme's changelog instead of an error, because GitHub refuses to load inside that popup.

## 1.0.3 (2026-10-13)

### Security
- The Headless settings page now checks a nonce and the user's permission before saving, so the form can't be submitted from another site.

### Fixed
- Removed a PHP "undefined index" warning shown each time the settings page loaded.
- Saving a blank Frontend URL now works, so you can turn the redirect off.

### Added
- A `LICENSE` file (GPL-2.0).

## 1.0.2 (2026-10-13)

### Changed
- The author link now points to https://samiran.dev.

## 1.0.1 (2026-10-12)

### Added
- Full theme details (name, author, description, requirements, tags) and a screenshot, so the theme looks complete under Appearance > Themes.

### Changed
- The Frontend URL now defaults to blank. With no URL set the theme does not redirect; set it under Settings > Headless.

## 1.0.0 (2026-10-12)

### Added
- Theme updates are delivered through GitHub Releases (Plugin Update Checker).

### Changed
- The text domain is now `headless-theme`.

### For developers
- Adopt the engineering standard v1.8.0 (`engineering-standards.yml`, agent adapters, health files).
