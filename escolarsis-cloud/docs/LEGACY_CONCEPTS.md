# Legacy concepts mapped to Escolarsis Cloud

Source: `../docs/USERGUIDE.md` (EBAM manual).

## Roles (renamed in new code)

| Manual | Cloud constant |
|--------|----------------|
| Administrador | `Administrador` |
| Maestro | `Docente` |
| Alumno | `Alumno` |

## Core views → future modules

| Vista legacy | M1 foundation | M2+ work |
|--------------|---------------|----------|
| Escuela | `organizations` | Settings UI |
| Grupos / grupo-curso | `programs` + `enrollments` | Group assignments |
| Alumnos | `people`, `students` | CRUD API |
| Matrículas | `enrollments` (unique constraints) | Bulk enroll |
| Cursos / materias | `programs` metadata | `courses`, `subjects` tables |
| Sesión (notas) | — | `grade_sessions`, scores |
| Promedios | — | Aggregations + PDF |
| Reportes disciplinarios | — | `behavior_reports` |
| Horarios | — | `schedules` |

## UX patterns to preserve

- Guided grading flow: course → subject → period → date → student → scores
- “Save without close” for batch grade entry
- Role-filtered lists (admin sees all, docente own subjects, alumno read-only)

## Explicitly deferred

- Finance, inventory, legacy `Cliente` / `Vendedor` / `Almacenero` naming
- Full university hierarchy (faculties, careers) — use `institution_type` + config first
