# Aspirasi

Laravel 12 app for collecting student feedback (**Aspirasi**) and managing it in an admin dashboard.

## Requirements
- Docker + Docker Compose

## Quick start (Docker)
1. `docker compose up -d --build`
2. `docker compose exec php bash`
3. `composer setup`

The app runs at: `http://localhost`

## Services
- Postgres (only): `db` service in `docker-compose.yml`
- Mailpit (email testing): `http://localhost:8025`
- pgAdmin (Postgres UI): `http://localhost:5050`
- Adminer (DB UI): `http://localhost:9090`

## Useful commands
- Run tests: `vendor/bin/pest`
- Format PHP: `vendor/bin/pint`
- Refactor (Rector): `vendor/bin/rector process`

## Notes
- Authentication is password-based (`App\Http\Controllers\Auth\LoginController`). OTP login is intentionally not used.
- Aspirasi status values are `on_progress` and `complete` (see `database/migrations/*create_aspirasis_table.php`).