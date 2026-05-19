#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT"

SAIL="./vendor/bin/sail"

if [[ ! -x "$SAIL" ]]; then
  echo "Sail not found. Run: composer install && php artisan sail:install"
  exit 1
fi

echo "==> PHPUnit via Sail"
$SAIL test

echo "==> Playwright (placeholder — wire in M2+)"
if [[ -f package.json ]] && grep -q playwright package.json 2>/dev/null; then
  $SAIL npm run test:e2e
else
  echo "    Skipped: no Playwright suite configured yet."
fi

echo "==> All M1 verification steps passed."
