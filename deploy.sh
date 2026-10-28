#!/usr/bin/env bash
# ------------------------------------------------------------------
#  Deploy the latest `main` on the aaPanel server.
#
#  Run it from the aaPanel terminal (Terminal → or SSH):
#      cd /www/wwwroot/LMS && bash deploy.sh
#
#  Steps: pull main → composer → migrate → front-end build (if needed)
#         → Laravel caches → file permissions. The site shows the
#         maintenance page while it runs and comes back automatically,
#         even if a step fails.
# ------------------------------------------------------------------
set -Eeuo pipefail

cd "$(dirname "$0")"
APP_DIR="$(pwd)"
BRANCH="main"
WEB_USER="${WEB_USER:-www}"   # aaPanel runs PHP as "www"

# Pick PHP: $PHP_BIN, else `php` on PATH, else the newest aaPanel PHP.
PHP="${PHP_BIN:-}"
if [ -z "$PHP" ]; then
  if command -v php >/dev/null 2>&1; then
    PHP="$(command -v php)"
  else
    PHP="$(ls -d /www/server/php/*/bin/php 2>/dev/null | sort -V | tail -n1 || true)"
  fi
fi
[ -x "$PHP" ] || { echo "ERROR: PHP not found. Run: PHP_BIN=/www/server/php/82/bin/php bash deploy.sh"; exit 1; }

step() { printf '\n\033[1;34m[%s] %s\033[0m\n' "$1" "$2"; }
ok()   { printf '\033[0;32m  ✓ %s\033[0m\n' "$1"; }
warn() { printf '\033[0;33m  ! %s\033[0m\n' "$1"; }

WENT_DOWN=0
bring_up() {
  if [ "$WENT_DOWN" = 1 ]; then "$PHP" artisan up >/dev/null 2>&1 || true; fi
}
on_error() {
  bring_up
  printf '\n\033[1;31mDEPLOY FAILED at line %s. The site is back online with the previous code where possible.\033[0m\n' "$1"
}
trap 'on_error $LINENO' ERR
trap bring_up EXIT

echo "========================================"
echo "  DEPLOY $BRANCH  →  $APP_DIR"
echo "  PHP: $("$PHP" -r 'echo PHP_VERSION;')"
echo "========================================"

step 1/7 "Checking the server copy"
current="$(git rev-parse --abbrev-ref HEAD)"
if [ "$current" != "$BRANCH" ]; then
  git switch "$BRANCH"
fi
if [ -n "$(git status --porcelain --untracked-files=no)" ]; then
  echo "ERROR: Files were edited directly on the server:"
  git status --short --untracked-files=no
  echo "Keep them with 'git stash', or drop them with 'git checkout -- .', then run deploy.sh again."
  exit 1
fi
before="$(git rev-parse --short HEAD)"
ok "On $BRANCH at $before, no local edits"

step 2/7 "Pulling latest $BRANCH from GitHub"
git fetch origin "$BRANCH"
if [ "$(git rev-parse HEAD)" = "$(git rev-parse "origin/$BRANCH")" ]; then
  warn "Already up to date — refreshing caches anyway"
fi
changed="$(git diff --name-only HEAD "origin/$BRANCH" || true)"

"$PHP" artisan down --retry=15 >/dev/null 2>&1 && WENT_DOWN=1 && ok "Maintenance mode on"
git merge --ff-only "origin/$BRANCH"
after="$(git rev-parse --short HEAD)"
ok "$before → $after"

step 3/7 "Installing PHP packages"
if command -v composer >/dev/null 2>&1; then
  COMPOSER_ALLOW_SUPERUSER=1 "$PHP" "$(command -v composer)" install --no-dev --optimize-autoloader --no-interaction --no-progress
  ok "Composer done"
else
  warn "composer not found — skipped (install it in aaPanel → App Store → PHP → Composer)"
fi

step 4/7 "Running database migrations"
"$PHP" artisan migrate --force
ok "Database up to date"

step 5/7 "Front-end assets"
if [ ! -f public/build/manifest.json ] || grep -qE '^(resources/(js|css)/|package(-lock)?\.json|vite\.config\.js|tailwind\.config\.js)' <<< "$changed"; then
  if command -v npm >/dev/null 2>&1; then
    npm ci --no-audit --no-fund && npm run build
    ok "Built public/build"
  else
    warn "npm not found — public/build not rebuilt (install Node.js in aaPanel → App Store)"
  fi
else
  ok "No front-end changes"
fi

step 6/7 "Refreshing Laravel caches"
"$PHP" artisan optimize:clear >/dev/null
if "$PHP" artisan optimize >/dev/null 2>&1; then
  ok "Config, routes, views and events cached"
else
  warn "Full cache failed — caching config and views only"
  "$PHP" artisan config:cache >/dev/null
  "$PHP" artisan view:cache >/dev/null
fi

step 7/7 "Fixing file permissions"
if id "$WEB_USER" >/dev/null 2>&1; then
  chown -R "$WEB_USER:$WEB_USER" storage bootstrap/cache public/uploads 2>/dev/null || true
fi
chmod -R ug+rwX storage bootstrap/cache 2>/dev/null || true
ok "storage/ and bootstrap/cache writable by $WEB_USER"

"$PHP" artisan up >/dev/null && WENT_DOWN=0
trap - ERR

echo
echo "========================================"
printf '\033[1;32m  DEPLOYED %s → %s\033[0m\n' "$before" "$after"
git log --oneline "$before..$after" 2>/dev/null | head -15 | sed 's/^/  /'
echo "========================================"
