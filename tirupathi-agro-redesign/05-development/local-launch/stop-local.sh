#!/usr/bin/env bash
set -euo pipefail

BASE_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$BASE_DIR"

PID_FILE="$BASE_DIR/.preview-server.pid"

if command -v docker >/dev/null 2>&1; then
  if docker compose version >/dev/null 2>&1; then
    docker compose down >/dev/null 2>&1 || true
  elif command -v docker-compose >/dev/null 2>&1; then
    docker-compose down >/dev/null 2>&1 || true
  fi
fi

if [ -f "$PID_FILE" ]; then
  PID="$(cat "$PID_FILE")"
  if [ -n "$PID" ] && kill -0 "$PID" >/dev/null 2>&1; then
    kill "$PID" || true
    echo "Stopped fallback preview server (PID $PID)."
  fi
  rm -f "$PID_FILE"
fi

pkill -f "serve-preview.py" >/dev/null 2>&1 || true

echo "Local launch services stopped."
