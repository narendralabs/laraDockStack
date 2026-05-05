# laraDockStack

A lightweight Docker development stack for PHP, Node, SQL, NoSQL, cache, queue, search, object storage, mail catching, and browser-based admin tools.
The structure follows the phase plan in [DEVELOPMENT.md](DEVELOPMENT.md), with a Devilbox-inspired feature model: zero-conf projects, small by default, expandable through Docker Compose profiles.

## Requirements

- Docker
- Docker Compose v2

## Quick Start

```sh
cp .env.example .env
docker compose build
docker compose up -d
```

Open `http://localhost` or `http://default.localhost` to verify the default PHP project.

## Projects

Projects live in `projects/<name>` and are served from `projects/<name>/public`.

```sh
./core/cli/devstack create api
./core/cli/devstack up
```

Open `http://api.localhost`.

## Services

- `web`: Nginx serving `projects/<name>/public` through `<name>.localhost`
- `php`: PHP-FPM with Composer and common Laravel extensions
- `mysql`: MySQL 8 by default
- `redis`: Redis with append-only persistence
- `node`: Node 20 by default, available through the `tools` profile or CLI helper

Optional profile services include MariaDB, PostgreSQL, MongoDB, Memcached, Mailpit, Adminer, phpMyAdmin, pgAdmin, Redis Commander, Mongo Express, RabbitMQ, Solr, and MinIO.

## Devilbox Alignment

This project uses the Devilbox README as a reference for product direction:

- automated project creation
- automatic vhosts and local DNS-friendly domains
- selective, on-demand, and full-stack startup
- PHP/static app support first, reverse proxy apps next
- intranet/control panel for tools and runtime status
- broad SQL, NoSQL, cache, queue, search, storage, and utility services
- version-switchable runtimes and project-aware PHP selection

See [docs/devilbox-reference.md](docs/devilbox-reference.md) for the detailed checklist.

## Configuration

Update `.env` to change versions, ports, credentials, or the active project path.

```sh
PHP_VERSION=8.3
NODE_VERSION=20
MYSQL_VERSION=8.0
DEFAULT_PROJECT=default
DEVSTACK_DOMAIN=localhost
APP_PORT=80
```

## Automatic PHP Version

The CLI can inspect `projects/<name>/composer.json` and choose the PHP image from the Laravel major version. The PHP image uses a full practical extension preset by default, and Composer `ext-*` requirements are scanned so unsupported requirements can be reported.

```sh
./core/cli/devstack use myapp
./core/cli/devstack up myapp
```

Current mapping:

- Laravel 13 -> PHP 8.4
- Laravel 11/12 -> PHP 8.3
- Laravel 10 -> PHP 8.2
- Laravel 9 -> PHP 8.1
- Laravel 8 -> PHP 8.0

See [docs/runtime-detection.md](docs/runtime-detection.md).

## Profiles

Start only what you need:

```sh
docker compose up -d
docker compose --profile tools up -d
docker compose --profile db --profile tools up -d
docker compose --profile nosql --profile cache up -d
```

Start the full stack:

```sh
./core/cli/devstack full
```

When `tools` is enabled, the intranet is available at `http://localhost:8079`.

## CLI Helper

```sh
chmod +x core/cli/devstack
./core/cli/devstack up
./core/cli/devstack full
./core/cli/devstack logs
./core/cli/devstack composer install
./core/cli/devstack node npm install
./core/cli/devstack down
```

See [docs/features.md](docs/features.md) for the current feature matrix.
