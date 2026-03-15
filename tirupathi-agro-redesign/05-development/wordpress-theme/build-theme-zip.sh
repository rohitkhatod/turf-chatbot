#!/usr/bin/env bash
set -euo pipefail

THEME_DIR="$(cd "$(dirname "$0")" && pwd)"
OUTPUT_DIR="$THEME_DIR/dist"
THEME_SLUG="tirupathi-agro-modern"

mkdir -p "$OUTPUT_DIR"

TMP_DIR="$(mktemp -d)"
trap 'rm -rf "$TMP_DIR"' EXIT

rsync -a --delete \
  --exclude '.git' \
  --exclude 'dist' \
  --exclude '*.zip' \
  "$THEME_DIR/" "$TMP_DIR/$THEME_SLUG/"

(cd "$TMP_DIR" && zip -r "$OUTPUT_DIR/${THEME_SLUG}.zip" "$THEME_SLUG" >/dev/null)

echo "Theme package created: $OUTPUT_DIR/${THEME_SLUG}.zip"
