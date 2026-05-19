# Escolarsis Cloud

Student information system reboot (EBAM / Escolarsis), multi-tenant from day one.

## Quick start (Sail)

```bash
cd escolarsis-cloud
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
```

Default admin (after seed):

| Field | Value |
|-------|-------|
| Email | `admin@escolarsis.test` |
| Password | `password` |
| Organization slug | `demo` |

API base: `http://localhost/api/v1`

## Verify

```bash
./scripts/verify.sh
```

## Docs

- [ARCHITECTURE.md](./ARCHITECTURE.md) — web/API split, tenancy, roles
- Legacy user flows: `../docs/USERGUIDE.md` (parent repo)

## Milestone 1 scope

- Organizations, users, RBAC, academic years, programs, people, students, teachers, enrollments
- Sanctum auth skeleton
- PHPUnit feature tests (auth, tenant scope, enrollment uniqueness)

## Milestone 2 (planned)

- Vue 3 SPA, CRUD APIs, grade sessions (sesiones), subjects, terms, policies per role
