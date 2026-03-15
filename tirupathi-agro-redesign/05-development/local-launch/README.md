# Local Launch (WordPress + MySQL)

This setup runs the Tirupathi Agro website locally.

## Mode A: Full WordPress (preferred)
If Docker is available, it starts WordPress + MySQL via Docker Compose.

## Mode B: Fallback Preview (automatic)
If Docker is not available, it automatically starts a static preview server of the implemented homepage at `http://localhost:8080`.

## Start
```bash
cd tirupathi-agro-redesign/05-development/local-launch
./launch-local.sh
```

## Stop
```bash
./stop-local.sh
```

## Notes
- WordPress mode: finish setup wizard, then activate **Tirupathi Agro Modern** theme.
- Fallback mode: serves `../wordpress-theme/preview.html` at `/`.
