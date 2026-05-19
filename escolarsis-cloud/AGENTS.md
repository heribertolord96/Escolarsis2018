# Agent instructions — Escolarsis Cloud

## Project location

- **New app:** this directory (`escolarsis-cloud/`) — Laravel 12 + Vite + Sail
- **Legacy (read-only):** `../legacy/` — Laravel 5.5 + Webpack Mix
- **Shared docs:** `../docs/`

## Development loop

1. Read `docs/ARCHITECTURE.md` before structural changes.
2. Implement in `app/Services/` + thin controllers; never put business rules in controllers.
3. All tenant data must use `organization_id` and respect `OrganizationContext`.
4. API routes only under `routes/api.php` prefix `v1`.
5. Run `./scripts/verify.sh` after changes; fix failures before finishing.
6. Do **not** implement finance/billing in academic milestones.
7. Use role names: `Administrador`, `Docente`, `Alumno` (not Vendedor/Almacenero).

## Commands

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
./vendor/bin/sail test
./scripts/verify.sh
```

## Commits

Only commit when the user explicitly asks.

## Milestone boundaries

| Milestone | Focus |
|-----------|--------|
| M1 | Tenancy, auth, core schema, tests, docs |
| M2 | Vue 3 SPA, CRUD APIs, sesiones/calificaciones |
| M3 | Reportes, horarios, PDF, policies hardening |
