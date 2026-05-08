# Local Development Stack Alignment

This project is building a similar local development experience directly inside this repository, with its own Docker Compose services, CLI, templates, and intranet.

## Goals

The target experience is a zero-configuration Docker development stack with:

- LEMP and MEAN-style workflows.
- Automated reverse proxy integration for WebSockets, Node, Python, and Go.
- Unlimited projects with automatic vhosts, DNS records, and SSL certificates.
- Inter-project communication for microservice/API landscapes.
- Selective, on-demand, and full-stack startup modes.
- An intranet/control panel for vhosts, tools, email, and runtime status.
- Multiple versions for attachable services.

## Current Alignment

| Local stack area | Devstack status |
| --- | --- |
| Zero-conf project creation | Partial: `devstack create <name>` creates `projects/<name>/public`. |
| Unlimited projects | Partial: `<project>.localhost` maps to `projects/<project>/public`. |
| Static/PHP files | Implemented with selectable Nginx or Apache plus PHP-FPM. |
| Reverse proxy mode | Implemented with per-project `.reverse-proxy` metadata for Nginx and Apache startup generation. |
| WebSockets | Partial: Nginx reverse proxy includes upgrade headers. |
| Node backend | Partial: Node CLI/tool container exists and can be reverse-proxied. |
| Python backend | Partial: Python runtime container and template exist and can be reverse-proxied. |
| Go backend | Partial: Go runtime container and template exist and can be reverse-proxied. |
| Automated SSL | Planned. |
| Automated DNS | Partial for `.localhost`; planned for custom domains. |
| Inter-project communication | Partial through shared Docker network. |
| Intranet | Partial: static tool dashboard exists. |
| Selective startup | Implemented with `minimal`, `start`, `install`, `stop`, `restart`, `enable`, `disable`, and `full`. |
| Email interception | Implemented with Mailpit profile. |
| Admin tools | Implemented: Adminer, phpMyAdmin, pgAdmin, Redis Commander, Mongo Express. |
| SQL services | Implemented: MySQL, MariaDB, PostgreSQL. |
| NoSQL services | Implemented: MongoDB. |
| Cache services | Implemented: Redis, Memcached. |
| Queue/search/storage | Implemented: RabbitMQ, Solr, MinIO. |
| Profiling | Partial: Xdebug is in the PHP extension preset; Blackfire/XHProf planned. |
| Version matrix | Partial: env-based versions, Laravel-to-PHP detection, and per-project `.php-version` metadata. |
| Host permission sync | Planned. |

## Implementation Priorities

1. Add runtime execution helpers for Node, Python, and Go development servers.
2. Add HTTPS certificate automation for local trusted development.
3. Add DNS/hosts helper commands for custom domains.
4. Add PHP 8.0 and PHP 8.3 named pools so mixed PHP versions can run simultaneously.
5. Add intranet runtime status by reading Docker service metadata.
6. Add full Laravel and WordPress installers.
7. Add Blackfire and XHProf toggles.
8. Add permission sync helpers for Linux host/container UID and GID handling.
