# Devilbox Reference Alignment

This project uses the Devilbox README as a product reference, not as code to copy.

Source: <https://github.com/cytopia/devilbox/blob/master/README.md>

## Reference Goals

Devilbox positions itself as a zero-configuration Docker development stack with:

- LEMP and MEAN-style workflows.
- Automated reverse proxy integration for WebSockets, Node, Python, and Go.
- Unlimited projects with automatic vhosts, DNS records, and SSL certificates.
- Inter-project communication for microservice/API landscapes.
- Selective, on-demand, and full-stack startup modes.
- An intranet/control panel for vhosts, tools, email, and runtime status.
- Multiple versions for attachable services.

## Current Alignment

| Devilbox area | Devstack status |
| --- | --- |
| Zero-conf project creation | Partial: `devstack create <name>` creates `projects/<name>/public`. |
| Unlimited projects | Partial: `<project>.localhost` maps to `projects/<project>/public`. |
| Static/PHP files | Implemented with Nginx and PHP-FPM. |
| Reverse proxy mode | Planned. |
| WebSockets | Planned through reverse proxy mode. |
| Node backend | Partial: Node CLI/tool container exists. |
| Python backend | Planned. |
| Go backend | Planned. |
| Automated SSL | Planned. |
| Automated DNS | Partial for `.localhost`; planned for custom domains. |
| Inter-project communication | Partial through shared Docker network. |
| Intranet | Partial: static tool dashboard exists. |
| Email interception | Implemented with Mailpit profile. |
| Admin tools | Implemented: Adminer, phpMyAdmin, pgAdmin, Redis Commander, Mongo Express. |
| SQL services | Implemented: MySQL, MariaDB, PostgreSQL. |
| NoSQL services | Implemented: MongoDB. |
| Cache services | Implemented: Redis, Memcached. |
| Queue/search/storage | Implemented: RabbitMQ, Solr, MinIO. |
| Profiling | Partial: Xdebug is in the PHP extension preset; Blackfire/XHProf planned. |
| Version matrix | Partial: env-based versions and Laravel-to-PHP detection. |
| Host permission sync | Planned. |

## Implementation Priorities

1. Add reverse proxy app mode with per-project config files.
2. Add HTTPS certificate automation for local trusted development.
3. Add DNS/hosts helper commands for custom domains.
4. Add multiple PHP-FPM services so mixed PHP versions can run simultaneously.
5. Add intranet runtime status by reading Docker service metadata.
6. Add Python and Go backend templates.
7. Add Blackfire and XHProf toggles.
8. Add permission sync helpers for Linux host/container UID and GID handling.
