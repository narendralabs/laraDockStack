# laraDockStack

**A modular Docker development stack for PHP, Laravel, WordPress, Node, Python, Go, databases, caches, queues, search, object storage, mail testing, and browser-based admin tools.**

laraDockStack gives you a local development environment where projects live in `projects/<name>`, get automatic `<name>.localhost` URLs, and can run on a small default stack or a larger full-service environment when needed.

It is built around a simple CLI, selectable services, and Docker Compose profiles so developers can start only what they need.

## Why laraDockStack?

- Start small with Nginx or Apache, PHP-FPM, MySQL, and Redis.
- Add databases, tools, queues, search, storage, and app runtimes on demand.
- Create projects with local URLs like `http://api.localhost`.
- Run PHP/static projects directly from `projects/<name>/public`.
- Reverse-proxy Node, Python, Go, or custom HTTP app servers.
- Manage common workflows through `./core/cli/devstack` instead of memorizing Compose commands.

## Feature Overview

| Area | Support |
| --- | --- |
| Web servers | Selectable Nginx or Apache |
| PHP | PHP-FPM, Composer, common Laravel/WordPress extensions |
| PHP versions | 8.0, 8.1, 8.2, 8.3, 8.4 metadata/pools |
| App runtimes | Node, Python, Go |
| SQL | MySQL, MariaDB, PostgreSQL |
| NoSQL | MongoDB |
| Cache | Redis, Memcached |
| Queue | RabbitMQ |
| Search | Solr |
| Storage | MinIO |
| Mail testing | Mailpit |
| Admin tools | Adminer, phpMyAdmin, pgAdmin, Redis Commander, Mongo Express |
| Dashboard | Intranet at `http://localhost:8079` |

## Requirements

- Docker
- Docker Compose v2

## Quick Start

```sh
cp .env.example .env
./core/cli/devstack build
./core/cli/devstack minimal
```

Open `http://localhost` or `http://default.localhost` to verify the default PHP project.

## Projects

Projects live in `projects/<name>` and are served from `projects/<name>/public`.

```sh
./core/cli/devstack create api
./core/cli/devstack create worker python
./core/cli/devstack create service go
./core/cli/devstack up
```

Open `http://api.localhost`.

## Services

- `web`: Nginx serving `projects/<name>/public` through `<name>.localhost`
- `apache`: Apache HTTPD alternative for the same project routing, enabled when selected
- `php`: PHP-FPM with Composer and common Laravel extensions
- `mysql`: MySQL 8 by default
- `redis`: Redis with append-only persistence
- `node`: Node 20 by default, available through the `tools` profile or CLI helper
- `python`: Python runtime container for reverse-proxied app projects
- `go`: Go runtime container for reverse-proxied app projects

Optional profile services include Apache, Python, Go, MariaDB, PostgreSQL, MongoDB, Memcached, Mailpit, Adminer, phpMyAdmin, pgAdmin, Redis Commander, Mongo Express, RabbitMQ, Solr, and MinIO.

## Local Stack Model

This project is growing toward a full local development control panel and CLI:

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
PYTHON_VERSION=3.12
GO_VERSION=1.22
MYSQL_VERSION=8.0
DEFAULT_PROJECT=default
DEVSTACK_DOMAIN=localhost
WEB_SERVER=nginx
COMPOSE_PROFILES=web-nginx
APP_PORT=80
```

## Web Server Selection

Nginx is selected by default. Switch to Apache when a project needs Apache behavior such as `.htaccess` support:

```sh
./core/cli/devstack web apache
./core/cli/devstack up
```

Switch back to Nginx:

```sh
./core/cli/devstack web nginx
./core/cli/devstack up
```

You can also select the web server while starting:

```sh
./core/cli/devstack up --apache
./core/cli/devstack full --nginx
./core/cli/devstack build --apache
```

## Selectable Services

List everything the stack can start:

```sh
./core/cli/devstack services
```

Start the minimal stack:

```sh
./core/cli/devstack minimal
```

Enable service groups in `.env`:

```sh
./core/cli/devstack enable tools db
./core/cli/devstack disable db
```

Start services or groups on demand:

```sh
./core/cli/devstack start mailpit
./core/cli/devstack start db
./core/cli/devstack start runtimes
./core/cli/devstack install apache
./core/cli/devstack stop mailpit
./core/cli/devstack restart httpd
```

## Project Modes

Create projects from built-in templates:

```sh
./core/cli/devstack create site php
./core/cli/devstack create api python
./core/cli/devstack create service go
```

List project vhosts and inspect routing:

```sh
./core/cli/devstack projects
./core/cli/devstack projects api
```

Route a project to an app server:

```sh
./core/cli/devstack proxy api python 8000
./core/cli/devstack proxy frontend node 3000
./core/cli/devstack proxy service go 8080
./core/cli/devstack unproxy api
```

Run a development server inside the matching runtime container:

```sh
./core/cli/devstack serve api python
./core/cli/devstack serve frontend node
./core/cli/devstack serve service go
```

Set project-specific PHP metadata for mixed PHP pools:

```sh
./core/cli/devstack php-version legacy 8.1
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

Start only what you need through the CLI:

```sh
./core/cli/devstack minimal
./core/cli/devstack start tools
./core/cli/devstack start db
./core/cli/devstack start nosql cache runtimes
```

Start the full stack:

```sh
./core/cli/devstack full
```

When `tools` is enabled, the intranet is available at `http://localhost:8079`.

## Tool URLs

When the matching services are running:

| Tool | URL |
| --- | --- |
| Intranet | `http://localhost:8079` |
| Mailpit | `http://localhost:8025` |
| Adminer | `http://localhost:8081` |
| phpMyAdmin | `http://localhost:8082` |
| pgAdmin | `http://localhost:8083` |
| Redis Commander | `http://localhost:8084` |
| Mongo Express | `http://localhost:8085` |
| RabbitMQ Management | `http://localhost:15672` |
| Solr | `http://localhost:8983` |
| MinIO Console | `http://localhost:9001` |

## CLI Helper

```sh
chmod +x core/cli/devstack
./core/cli/devstack up
./core/cli/devstack web apache
./core/cli/devstack services
./core/cli/devstack projects
./core/cli/devstack start mailpit
./core/cli/devstack full
./core/cli/devstack logs
./core/cli/devstack composer install
./core/cli/devstack node npm install
./core/cli/devstack down
```

See [docs/features.md](docs/features.md) for the current feature matrix.

## Roadmap

- Trusted local HTTPS automation
- Custom DNS and hosts helpers
- Intranet runtime status from Docker metadata
- Full Laravel and WordPress installers
- Blackfire and XHProf toggles
- Permission sync helpers for Linux hosts
- More runtime templates and per-project metadata

## Documentation

- [Feature matrix](docs/features.md)
- [Runtime detection](docs/runtime-detection.md)
- [Service connections](docs/connections.md)
- [Development guide](DEVELOPMENT.md)

## License

See [LICENSE](LICENSE).
