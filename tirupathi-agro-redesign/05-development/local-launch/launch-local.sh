#!/usr/bin/env bash
set -euo pipefail

BASE_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$BASE_DIR"

PID_FILE="$BASE_DIR/.preview-server.pid"
LOG_FILE="$BASE_DIR/.preview-server.log"

is_preview_healthy() {
  curl -fsS "http://127.0.0.1:8080/" >/dev/null 2>&1
}

is_valid_preview_pid() {
  local pid="$1"

  if ! kill -0 "$pid" >/dev/null 2>&1; then
    return 1
  fi

  local stat
  stat="$(ps -p "$pid" -o stat= 2>/dev/null | tr -d '[:space:]')"
  if [ -z "$stat" ] || [[ "$stat" == Z* ]]; then
    return 1
  fi

  local cmd
  cmd="$(ps -p "$pid" -o args= 2>/dev/null || true)"
  [[ "$cmd" == *"serve-preview.py"* ]]
}

start_fallback() {
  if is_preview_healthy; then
    echo "Preview already reachable at http://localhost:8080"
    return
  fi

  if [ -f "$PID_FILE" ]; then
    PID="$(cat "$PID_FILE")"
    if [ -n "$PID" ] && is_valid_preview_pid "$PID"; then
      echo "Fallback preview server already running at http://localhost:8080"
      return
    fi
    rm -f "$PID_FILE"
  fi

  nohup python3 "$BASE_DIR/serve-preview.py" >"$LOG_FILE" 2>&1 &
  echo $! >"$PID_FILE"
  sleep 1

  if is_preview_healthy; then
    echo "Launched fallback preview at http://localhost:8080"
  else
    echo "Failed to start fallback preview server. Check $LOG_FILE"
    exit 1
  fi
}

if command -v docker >/dev/null 2>&1; then
  if docker compose version >/dev/null 2>&1; then
    COMPOSE_CMD="docker compose"
  elif command -v docker-compose >/dev/null 2>&1; then
    COMPOSE_CMD="docker-compose"
  else
    echo "Docker Compose plugin/binary not found. Falling back to static preview server."
    start_fallback
    exit 0
  fi

  $COMPOSE_CMD up -d

  echo "Local WordPress is starting at http://localhost:8080"
  echo "Next steps after first load:"
  echo "1) Complete WordPress install wizard"
  echo "2) Activate theme: Appearance -> Themes -> Tirupathi Agro Modern"
  echo "3) Set static homepage"
  exit 0
fi

echo "Docker not found. Launching fallback preview server instead."
start_fallback
