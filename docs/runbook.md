# Runbook

## Local Checks

```sh
composer validate --strict --no-check-lock
find . -path './vendor' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
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