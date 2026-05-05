ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-fpm-alpine

ARG PHP_EXTENSIONS="amqp apcu ast bcmath bz2 calendar exif gd gettext gmp igbinary imagick imap intl ldap mbstring memcached mongodb mysqli opcache pcntl pdo_mysql pdo_pgsql pgsql redis soap sockets swoole uuid xdebug xsl yaml zip"
ARG PHP_PECL_EXTENSIONS=""

COPY --from=mlocati/php-extension-installer:2 /usr/bin/install-php-extensions /usr/local/bin/

ARG INSTALL_BLACKFIRE=false
ARG INSTALL_XHPROF=false

RUN set -e; \
    EXTENSIONS="$PHP_EXTENSIONS"; \
    if [ "$INSTALL_BLACKFIRE" = "true" ]; then EXTENSIONS="$EXTENSIONS blackfire"; fi; \
    if [ "$INSTALL_XHPROF" = "true" ]; then EXTENSIONS="$EXTENSIONS xhprof"; fi; \
    apk add --no-cache \
        bash \
        git \
        openssh-client \
        unzip \
        zip \
    && install-php-extensions $EXTENSIONS $PHP_PECL_EXTENSIONS

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

WORKDIR /var/www/projects/default

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["php-fpm"]
