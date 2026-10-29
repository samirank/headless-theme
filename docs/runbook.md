# Runbook

## Local Checks

```sh
composer validate --strict --no-check-lock
find . -path './vendor' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
composer install && vendor/bin/phpunit
```

## Pull Request Review

1. Confirm the linked issue and acceptance criteria.
2. Review changed files and risk level.
3. Confirm CI is green.
4. Confirm security, deployment, and rollback sections are complete.
5. Confirm screenshots or browser evidence for user-visible changes when applicable.

## Rollback

Revert the merged commit through GitHub and redeploy the previous known-good theme version through the normal WordPress hosting process. For settings-only changes, restore the previous WordPress setting value from the documented change note.

## Incident Notes

If a change affects public site behavior, stop further rollout, capture sanitized evidence, revert or restore the previous theme version, and document the incident in a GitHub issue.
## Releases and Updates

1. Bump `Version` in `style.css` and add a `CHANGELOG.md` entry in a pull request; merge after review.
2. With the maintainer's approval, tag the merge commit `vX.Y.Z` and push the tag. The Release workflow builds `headless-theme.zip` and a SHA-256 checksum and attaches them to a GitHub Release.
3. Sites check the repository's releases through Plugin Update Checker and show the normal update notice under Appearance > Themes.
4. First install: download `headless-theme.zip` from the latest release and upload it under Appearance > Themes > Add New. Verify it with `headless-theme.zip.sha256`.
5. Rollback: install the previous release's zip over the current theme (Appearance > Themes > Add New > Upload, replace current).
