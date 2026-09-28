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
  # A stale PID file must never signal an unrelated process or process group.
  if [[ "$PID" =~ ^[1-9][0-9]*$ ]] && kill -0 "$PID" >/dev/null 2>&1; then
    CMD="$(ps -ww -p "$PID" -o args= 2>/dev/null || true)"
    if [[ "$CMD" == "python3 $BASE_DIR/serve-preview.py" ]]; then
      kill "$PID"
      echo "Stopped fallback preview server (PID $PID)."
    else
      echo "Ignoring stale PID file: PID $PID is not this project's preview." >&2
    fi
  fi
  rm -f "$PID_FILE"
fi

echo "Local launch services stopped."
