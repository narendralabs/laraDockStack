# Runtime Detection

Devstack can switch the active PHP image version from a project's Laravel version.

The CLI checks `projects/<name>/composer.json` for `laravel/framework` or `illuminate/support`, then updates `.env`:

- `DEFAULT_PROJECT=<name>`
- `PHP_VERSION=<detected-version>`
- `PHP_EXTENSIONS=<detected-and-default-extensions>`
- `PHP_PECL_EXTENSIONS=<detected-and-default-pecl-extensions>`

## Laravel Mapping

| Laravel major | PHP image |
| --- | --- |
| 13 | 8.4 |
| 12 | 8.3 |
| 11 | 8.3 |
| 10 | 8.2 |
| 9 | 8.1 |
| 8 | 8.0 |

Unknown projects keep the current `PHP_VERSION`.
Unknown projects use `PHP_DEFAULT_VERSION`, which defaults to `8.3`.

## Extension Detection

The CLI also scans Composer `ext-*` requirements and adds supported extensions to the PHP image build args.

The default PHP image uses a full practical extension preset:

`amqp apcu ast bcmath bz2 calendar exif gd gettext gmp igbinary imagick imap intl ldap mbstring memcached mongodb mysqli opcache pcntl pdo_mysql pdo_pgsql pgsql redis soap sockets swoole uuid xdebug xsl yaml zip`

Composer `ext-*` requirements are still scanned. Supported requirements are kept in the build list, and unsupported requirements are printed as warnings so they can be added deliberately.

Some extensions are intentionally not promised by the default preset because they require external proprietary or platform-specific client libraries, such as `oci8`, `pdo_oci`, `sqlsrv`, and `pdo_sqlsrv`.

## Commands

```sh
./core/cli/devstack runtime app
./core/cli/devstack use app
./core/cli/devstack up app
```

After `PHP_VERSION` changes, rebuild the PHP image:
After PHP version or extension changes, rebuild the PHP image:

```sh
docker compose build php
docker compose up -d
```

Set `DEVSTACK_RUNTIME_MODE=manual` in `.env` to stop automatic detection during `up` and `full`.
