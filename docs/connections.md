# Service Connections

Use these hostnames from application containers:

- Nginx web server: `web:80`
- Apache web server: `apache:80`
- Node runtime: `node:<project-port>`
- Python runtime: `python:<project-port>`
- Go runtime: `go:<project-port>`
- MySQL: `mysql:3306`
- MariaDB: `mariadb:3306`
- PostgreSQL: `postgres:5432`
- MongoDB: `mongo:27017`
- Redis: `redis:6379`
- Memcached: `memcached:11211`
- SMTP: `mailpit:1025`
- RabbitMQ: `rabbitmq:5672`
- Solr: `solr:8983`
- MinIO: `minio:9000`

Default database credentials are configured in `.env.example`.
