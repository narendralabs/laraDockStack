FROM httpd:2.4-alpine

RUN apk add --no-cache gettext openssl \
    && mkdir -p /usr/local/apache2/certs \
    && openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout /usr/local/apache2/certs/devstack-key.pem -out /usr/local/apache2/certs/devstack.pem -subj "/CN=*.localhost"

COPY templates/httpd.conf.template /usr/local/apache2/templates/httpd.conf.template
COPY docker-entrypoint.sh /usr/local/bin/devstack-apache-entrypoint

RUN chmod +x /usr/local/bin/devstack-apache-entrypoint

ENTRYPOINT ["devstack-apache-entrypoint"]
CMD ["httpd-foreground"]
