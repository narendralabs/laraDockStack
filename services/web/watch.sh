#!/bin/bash

if [ ! -f /etc/nginx/certs/devstack.pem ] || [ ! -f /etc/nginx/certs/devstack-key.pem ]; then
    mkdir -p /etc/nginx/certs
    openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout /etc/nginx/certs/devstack-key.pem -out /etc/nginx/certs/devstack.pem -subj "/CN=*.localhost"
fi

# Give Nginx a moment to start initially
sleep 2

generate_conf() {
    CONF_FILE="/etc/nginx/conf.d/projects-proxy.conf"
    echo "# Auto-generated proxy config" > $CONF_FILE
    
    for dir in /var/www/projects/*; do
        if [ -d "$dir" ]; then
            project=$(basename "$dir")
            if [ -f "$dir/.reverse-proxy" ]; then
                target=$(cat "$dir/.reverse-proxy" | tr -d '\r' | head -n 1)
                if [[ "$target" =~ ^[0-9]+$ ]]; then
                    target="http://node:$target"
                fi
                if [[ "$target" =~ ^https?://[A-Za-z0-9_.-]+(:[0-9]+)?(/.*)?$ ]]; then
                    cat >> $CONF_FILE <<EOF
server {
    listen 80;
    listen 443 ssl;
    server_name $project.\${DEVSTACK_DOMAIN};
    ssl_certificate /etc/nginx/certs/devstack.pem;
    ssl_certificate_key /etc/nginx/certs/devstack-key.pem;
    location / {
        proxy_pass $target;
        proxy_http_version 1.1;
        proxy_set_header Upgrade \$http_upgrade;
        proxy_set_header Connection "Upgrade";
        proxy_set_header Host \$host;
        proxy_set_header X-Real-IP \$remote_addr;
    }
}
EOF
                fi
            elif [ -f "$dir/.php-version" ]; then
                php_ver=$(cat "$dir/.php-version" | tr -d '\r' | tr -d '.')
                cat >> $CONF_FILE <<EOF
server {
    listen 80;
    listen 443 ssl;
    server_name $project.\${DEVSTACK_DOMAIN};
    ssl_certificate /etc/nginx/certs/devstack.pem;
    ssl_certificate_key /etc/nginx/certs/devstack-key.pem;
    root /var/www/projects/$project/public;
    index index.php index.html;
    charset utf-8;
    client_max_body_size 64m;
    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }
    location ~ \.php$ {
        try_files \$uri =404;
        fastcgi_pass php\${php_ver}:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        fastcgi_param DOCUMENT_ROOT \$realpath_root;
        include fastcgi_params;
    }
}
EOF
            fi
        fi
    done
    nginx -s reload
}

generate_conf

# Watch for changes to .reverse-proxy files
while inotifywait -e close_write,create,delete,move -r /var/www/projects 2>/dev/null; do
    generate_conf
done
