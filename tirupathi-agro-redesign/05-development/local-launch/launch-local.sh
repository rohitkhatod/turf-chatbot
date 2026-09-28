#!/usr/bin/env bash
set -euo pipefail

BASE_DIR="$(cd "$(dirname "$0")" && pwd)"
cd "$BASE_DIR"

PID_FILE="$BASE_DIR/.preview-server.pid"
LOG_FILE="$BASE_DIR/.preview-server.log"

is_preview_healthy() {
  local response
  response="$(curl --noproxy '*' -fsS --max-time 2 \
    "http://127.0.0.1:8080/__preview_health" 2>/dev/null)" || return 1
  [[ "$response" == "tirupathi-preview:$1" ]]
}

is_valid_preview_pid() {
  local pid="$1"

  [[ "$pid" =~ ^[1-9][0-9]*$ ]] || return 1

  if ! kill -0 "$pid" >/dev/null 2>&1; then
    return 1
  fi

  local stat
  stat="$(ps -ww -p "$pid" -o stat= 2>/dev/null | tr -d '[:space:]')"
  if [ -z "$stat" ] || [[ "$stat" == Z* ]]; then
    return 1
  fi

  local cmd
  cmd="$(ps -ww -p "$pid" -o args= 2>/dev/null || true)"
  [[ "$cmd" == "python3 $BASE_DIR/serve-preview.py" ]]
}

start_fallback() {
  if [ -f "$PID_FILE" ]; then
    PID="$(cat "$PID_FILE")"
    if [ -n "$PID" ] && is_valid_preview_pid "$PID"; then
      if is_preview_healthy "$PID" && is_valid_preview_pid "$PID"; then
        echo "Fallback preview server already running at http://localhost:8080"
        return
      fi
      echo "Recorded preview process is not healthy. Run ./stop-local.sh before retrying." >&2
      return 1
    fi
    rm -f "$PID_FILE"
  fi

  nohup python3 "$BASE_DIR/serve-preview.py" >"$LOG_FILE" 2>&1 &
  PID=$!
  echo "$PID" >"$PID_FILE"
  sleep 1

  if is_valid_preview_pid "$PID" && is_preview_healthy "$PID" && is_valid_preview_pid "$PID"; then
    echo "Launched fallback preview at http://localhost:8080"
  else
    if is_valid_preview_pid "$PID"; then
      kill "$PID" || true
      wait "$PID" 2>/dev/null || true
    fi
    rm -f "$PID_FILE"
    echo "Failed to start fallback preview server; port 8080 may be in use. Check $LOG_FILE" >&2
    return 1
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
