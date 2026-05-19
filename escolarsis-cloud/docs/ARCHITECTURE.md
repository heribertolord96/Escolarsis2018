# Escolarsis Cloud — Architecture (Milestone 1)

## Stack

| Layer | Choice |
|-------|--------|
| Backend | Laravel 13 (fresh install; target was L12 — same patterns) |
| PHP | 8.3+ (Sail runtime 8.5) |
| Auth | Laravel Sanctum (SPA cookies + personal access tokens) |
| RBAC | `spatie/laravel-permission` |
| Dev environment | Laravel Sail (MySQL 8.4, Redis) |
| Frontend (M2) | Vue 3 + Vite (SPA shell only in M1) |

Legacy app remains in `../legacy/` (Laravel 5.5 + Webpack Mix). Active app is this folder (`escolarsis-cloud/`, Vite).

## Web vs API split

| Surface | Prefix | Responsibility |
|---------|--------|----------------|
| **Web** | `/`, `/up` | SPA shell (`resources/views/spa.blade.php`), health probe |
| **API** | `/api/v1/*` | All business logic, JSON only |

Examples:

- `GET /api/v1/health` — public health
- `POST /api/v1/auth/login` — session or token
- `GET /api/v1/auth/me` — authenticated profile (requires `auth:sanctum` + organization context)

Sanctum stateful middleware is prepended to the API stack for cookie-based SPA auth from the same domain.

## Application layout

```
app/
  Http/
    Controllers/Api/V1/   # Thin controllers
    Middleware/           # SetCurrentOrganization
    Requests/             # Form requests (validation)
    Resources/            # API transformers
  Models/                 # Eloquent domain models
    Concerns/             # BelongsToOrganization
    Scopes/               # OrganizationScope
  Services/               # Auth, OrganizationContext, future domain services
  Policies/               # (M2+) authorization per resource
```

Controllers delegate to services; models hold relationships and scopes only.

## Multi-tenant model

- **Tenant** = `organizations` row (`slug`, `institution_type`: `diplomado` | `university`).
- Tenant-owned tables include `organization_id` (FK, indexed).
- **`OrganizationContext`** singleton holds the active tenant for the request.
- **`SetCurrentOrganization`** middleware resolves tenant from:
  1. `X-Organization-Id` header
  2. `organization_id` query param
  3. Authenticated user's `organization_id`
- **`OrganizationScope`** global scope filters queries when context is set.

Single-tenant deploy: seed one organization (`OrganizationSeeder`, slug `demo`).

University-style structures (faculties, careers) are **not** modeled in M1; use `programs.metadata` and `organizations.settings` until configuration-driven hierarchy lands in M2+.

## Roles (RBAC)

Canonical names (legacy naming fixed in new code only):

| Role | Legacy code name | Access |
|------|------------------|--------|
| Administrador | Administrador | Full configuration |
| Docente | ~~Vendedor~~ / Maestro | Teaching operations |
| Alumno | ~~Almacenero~~ / Alumno | Own academic data read-only |

Seeded via `RoleSeeder`. Assign with `$user->assignRole('Docente')`.

## Finance module

**Deferred.** No billing, payments, or inventory in M1. A future `Finance` bounded context will live under `app/Services/Finance/` with separate routes — do not mix with academic tables.

## Domain ported from legacy (USERGUIDE)

M1 schema covers the foundation for:

| Legacy concept | Cloud model |
|----------------|-------------|
| Escuela / categoría | `organizations` |
| Grupos + cursos | `programs` (flexible) + enrollments (student-level) |
| Alumnos / personal | `people`, `students`, `teachers` |
| Matrícula | `enrollments` (unique per student/program/year) |
| Ciclo escolar | `academic_years` |

Not in M1: sesiones (grades), materias, periodos, reportes, horarios, PDF exports — Milestone 2+.

## Verification loop

```bash
./scripts/verify.sh
```

Runs `sail test` (and Playwright placeholder). After every change affecting API or schema, run tests until green.
