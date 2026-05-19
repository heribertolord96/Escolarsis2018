# Escolarsis Cloud

Rama **`escolarsis-cloud`**: solo el producto nuevo (Laravel 12+, Vite, Sail, Sanctum).

El código de la aplicación está en [`escolarsis-cloud/`](escolarsis-cloud/).

Documentación compartida: [`docs/`](docs/).

## Desarrollo

```bash
cd escolarsis-cloud
./vendor/bin/sail up -d
./vendor/bin/sail artisan migrate --seed
./scripts/verify.sh
```

## Otras ramas

| Rama | Contenido |
|------|-----------|
| `legacy` | EBAM 2018 — Laravel 5.5 + Webpack Mix (código en la raíz del repo) |
| `up` | Rama histórica en remoto (equivale a legacy hasta que se actualice) |
