# Contributing

## Workflow

1. Start from a GitHub issue with clear acceptance criteria.
2. Create a short-lived branch from `main`.
3. Keep changes scoped to the issue.
4. Run the required checks locally when possible.
5. Open a pull request using the repository template.
6. Wait for CI and review before merge.

## Required Checks

```sh
composer validate --strict --no-check-lock
find . -path './vendor' -prune -o -name '*.php' -print0 | xargs -0 -n1 php -l
```

## Scope Boundaries

Do not include real environment files, tokens, private keys, database dumps, logs, or production WordPress credentials. Do not change deployment behavior, authentication, authorization, or production data without explicit approval.