# Feature Matrix

This project is growing toward a Devilbox-style local development stack while keeping the default startup small. See [devilbox-reference.md](devilbox-reference.md) for the reference checklist.

## Implemented

- Environment-driven versions for PHP, Node, MySQL, MariaDB, PostgreSQL, MongoDB, RabbitMQ, Solr, and MinIO.
- Multi-project document roots under `projects/<name>/public`.
- Local vhosts with `<project>.localhost`.
- PHP-FPM and Nginx for static files and PHP applications.
- MySQL and Redis in the default stack.
- Optional MariaDB, PostgreSQL, MongoDB, Memcached, Mailpit, Adminer, phpMyAdmin, pgAdmin, Redis Commander, Mongo Express, RabbitMQ, Solr, and MinIO.
- CLI helper for create, up, full, down, build, ps, logs, exec, composer, and node commands.
- Intranet landing page for common tools.
- Full practical PHP extension preset using `install-php-extensions`.
- Laravel major version to PHP version detection.
- Composer `ext-*` scanning with warnings for unsupported extensions.

## Planned

- Automated trusted HTTPS certificates.
- Host file and DNS helper commands for non-`.localhost` domains.
- Reverse proxy mode for arbitrary Node, Python, Go, and websocket apps.
- Multiple PHP-FPM pools for simultaneous mixed PHP versions.
- Blackfire and XHProf profiling toggles.
- Framework templates for Laravel, WordPress, and API starters.
- Status checks in the intranet using Docker metadata.
- Linux host permission sync helpers.
- Selective service commands matching Devilbox-style on-demand startup.
