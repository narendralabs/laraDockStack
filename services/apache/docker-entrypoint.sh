#!/usr/bin/env sh
set -eu

: "${DEFAULT_PROJECT:=default}"
: "${DEVSTACK_DOMAIN:=localhost}"

if [ ! -f /usr/local/apache2/certs/devstack.pem ] || [ ! -f /usr/local/apache2/certs/devstack-key.pem ]; then
  mkdir -p /usr/local/apache2/certs
  openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout /usr/local/apache2/certs/devstack-key.pem -out /usr/local/apache2/certs/devstack.pem -subj "/CN=*.localhost"
fi

mkdir -p /usr/local/apache2/conf/extra
projects_conf="/usr/local/apache2/conf/extra/devstack-projects.conf"
printf '%s\n' "# Auto-generated project proxy config" > "$projects_conf"

for dir in /var/www/projects/*; do
  if [ -d "$dir" ] && [ -f "$dir/.reverse-proxy" ]; then
    project="$(basename "$dir")"
    target="$(head -n 1 "$dir/.reverse-proxy" | tr -d '\r')"
    case "$target" in
      ''|*[!A-Za-z0-9:/.?_%=+~-]*)
        continue
        ;;
    esac
    case "$target" in
      http://*|https://*) ;;
      *[!0-9]*) continue ;;
      *) target="http://node:$target" ;;
    esac

    cat >> "$projects_conf" <<EOF
<VirtualHost *:80>
    ServerName $project.${DEVSTACK_DOMAIN}
    ProxyPreserveHost On
    ProxyPass / $target/
    ProxyPassReverse / $target/
</VirtualHost>

<VirtualHost *:443>
    ServerName $project.${DEVSTACK_DOMAIN}
    SSLEngine on
    SSLCertificateFile "/usr/local/apache2/certs/devstack.pem"
    SSLCertificateKeyFile "/usr/local/apache2/certs/devstack-key.pem"
    ProxyPreserveHost On
    ProxyPass / $target/
    ProxyPassReverse / $target/
</VirtualHost>
EOF
  fi
done

envsubst '${DEFAULT_PROJECT} ${DEVSTACK_DOMAIN}' \
  < /usr/local/apache2/templates/httpd.conf.template \
  > /usr/local/apache2/conf/httpd.conf

exec "$@"
