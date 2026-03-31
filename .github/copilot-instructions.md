# Copilot instructions (aspirasi)

## Project overview
- Laravel 12 app for collecting **Aspirasi** (student feedback) and managing it in an **admin** dashboard.
- Main domain models: `App\Models\aspirasi` (feedback), `App\Models\Kategori` (category), `App\Models\PenanggungJawab` (person-in-charge), `App\Models\User` (auth + role).
- Views are Blade templates in `resources/views/` grouped by area: `admin/`, `siswa/`, `auth/`, and `emails/`.

## Key flows & conventions
- Roles are stored on `users.roles` and enforced via the custom `role` middleware alias (see `app/Http/Middleware/RoleMiddleware.php` + `bootstrap/app.php`).
  - Expected role strings: `admin`, `super_admin`, `siswa`.
- Aspirasi status is an enum in DB: `on_progress` or `complete` (see `database/migrations/*create_aspirasis_table.php`).
- Creating an aspirasi (student) sends an email to the category email (see `app/Http/Controllers/SiswaController.php`, mail: `app/Mail/AspirasiCreatedMail.php`, view: `resources/views/emails/aspiration_created.blade.php`).
- Admin replies / marks complete sends an email back to the student (see `app/Http/Controllers/Admin/FeedbackController.php`, mail: `app/Mail/AspirasiRespondedMail.php`, view: `resources/views/emails/aspiration_responded.blade.php`).
- Category assignment UI is consolidated under `Admin/CategoryAssignmentController` and updates `kategoris.penanggung_jawab_id` (see migrations `*create_penanggung_jawabs_table.php` + `*update_kategoris_for_penanggung_jawab.php`).

## Sharp edges (avoid accidental breakage)
- The Aspirasi model class/file is **lowercase**: `App\Models\aspirasi` in `app/Models/aspirasi.php`.
  - Follow existing usage (`use App\Models\aspirasi;` or alias it) and don’t introduce `App\Models\Aspirasi` unless you also rename consistently.
- Auth routes use `App\Http\Controllers\Auth\LoginController` (password login).
  - OTP login is **obsolete by design** in this repo; do not wire `Auth\OtpController` or the legacy OTP-based `App\Http\Controllers\LoginController` back into `routes/web.php`.

## Dev workflows (Docker-first)
- Start stack: `docker compose up -d --build`
- Shell into PHP container: `docker compose exec php bash`
- First-time setup (inside container): `composer setup` (installs deps, creates `.env`, generates key, caches config, migrates, builds assets)
- Database is **Postgres-only** via the `db` service (see `docker-compose.yml`); ensure `.env` matches (`DB_CONNECTION=pgsql`, host `db`).
- Frontend dev server: `npm run dev` (Vite; port 5173 is forwarded by the `php` service)
- Mail testing goes through Mailpit at `http://localhost:8025` (see `docker-compose.yml`).
- Run tests: `vendor/bin/pest`
- Style/automation:
  - Format/lint PHP: `vendor/bin/pint`
  - Refactors: `vendor/bin/rector process` (see `rector.php`)

### Optional (no Docker)
- `composer dev` runs `php artisan serve`, `queue:listen`, and `npm run dev` concurrently (see `composer.json`).

## When making changes
- Prefer extending existing controllers + Blade views rather than introducing new architectural layers.
- Keep validation rules close to request handling (see `SiswaController@storeAspirasi`, `Admin\UserController@store`, `Admin\FeedbackController@reply`).
- If you add/rename DB fields, update the corresponding `$fillable` and relationships in the model(s) and adjust the relevant Blade forms.