# 🚀 Devstack Development Guide

## 📌 Project Vision

Devstack is a modular, Docker-based development environment supporting:

- PHP (7.x → 8.x)
- Node (10 → latest)
- MySQL (5.x → latest)
- Apache & Nginx
- Laravel, WordPress, and custom apps

---

## 🎯 Goal

Build a lightweight, flexible alternative to:
- Devilbox
- Laradock
- Laravel Sail
- Laragon

Devilbox is the primary feature reference. Track alignment in `docs/devilbox-reference.md`.

---

## 🧠 Core Principles

1. Modular architecture (plugin-based)
2. Per-project isolation
3. Environment-driven configuration (.env)
4. Minimal by default, expandable when needed
5. Modern-first, legacy support later

---

## 📁 Repository Structure

devstack/
│
├── core/
│   ├── cli/
│   ├── proxy/
│
├── services/
│   ├── php/
│   ├── node/
│   ├── mysql/
│   ├── web/
│
├── templates/
│   ├── laravel/
│   ├── wordpress/
│
├── projects/
├── docs/
├── README.md
├── DEVELOPMENT.md

---

## 🏗️ Phase-Based Development Plan

### Phase 1: Minimal Working Stack (MVP)

- PHP 8.3
- Nginx
- MySQL 8
- Redis
- Node 20

Tasks:
- Create docker-compose.yml
- Create PHP Dockerfile
- Configure Nginx
- Test Laravel installation
- Verify DB + Redis connection

---

### Phase 2: Dynamic Version Support

Example:

PHP_VERSION=8.3
NODE_VERSION=20
MYSQL_VERSION=8

Tasks:
- Add ARG in Dockerfile
- Update docker-compose to use env variables
- Test multiple PHP versions
- Test Node switching

---

### Phase 3: Multi-Project Support

Tasks:
- Assign unique ports per project
- Ensure container isolation
- Test concurrent execution

---

### Phase 4: CLI Tool

Commands:

devstack create project-name
devstack up
devstack down
devstack exec

Tasks:
- Create CLI script
- Add command parsing
- Automate project scaffolding

---

### Phase 5: Reverse Proxy (Domain Routing)

Example:

project1.test
project2.test

Tasks:
- Setup proxy (Nginx or Traefik)
- Configure routing
- Update hosts file
- Support reverse proxy project mode for Node, Python, Go, and websocket apps
- Add per-project runtime metadata

---

### Phase 6: Legacy Support

- PHP 7.x
- Node 10–14
- MySQL 5.7

Tasks:
- Add compatibility checks
- Document limitations
- Test edge cases

---

### Phase 7: Templates

- Laravel
- WordPress
- API starter

Tasks:
- Create template folders
- Add install scripts
- Integrate with CLI

---

### Phase 8: Devilbox Parity Features

Tasks:
- Add trusted local HTTPS automation
- Add custom DNS/hosts helpers
- Add multiple PHP-FPM pools for simultaneous mixed PHP versions
- Add intranet runtime status from Docker metadata
- Add host permission sync helpers
- Add Blackfire and XHProf profiling toggles
- Add Python and Go backend templates

---

## 🧪 Testing Strategy

- Test each PHP version
- Test Node compatibility
- Test database connections
- Run multiple projects simultaneously

---

## 🏁 Final Goal

Create a tool that is:
- Easy to use
- Highly configurable
- Lightweight
- Production-like
- Developer-friendly

---

Happy Building 🚀
