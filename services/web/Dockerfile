FROM nginx:1.27-alpine
RUN apk add --no-cache inotify-tools bash openssl \
    && mkdir -p /etc/nginx/certs \
    && openssl req -x509 -nodes -days 3650 -newkey rsa:2048 -keyout /etc/nginx/certs/devstack-key.pem -out /etc/nginx/certs/devstack.pem -subj "/CN=*.localhost"
COPY watch.sh /usr/local/bin/watch.sh
RUN chmod +x /usr/local/bin/watch.sh
CMD ["/bin/bash", "-c", "/usr/local/bin/watch.sh & nginx -g 'daemon off;'"]
