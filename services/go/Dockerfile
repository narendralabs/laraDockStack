ARG GO_VERSION=1.22
FROM golang:${GO_VERSION}-alpine

RUN apk add --no-cache bash git

WORKDIR /var/www/projects/default

CMD ["tail", "-f", "/dev/null"]
