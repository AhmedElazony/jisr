NVM_USE = . ~/.nvm/nvm.sh && nvm use --lts
SHELL := /bin/bash

# SSL settings
SSL_DIR = ./docker/nginx/ssl
SSL_KEY = $(SSL_DIR)/private.key
SSL_CERT = $(SSL_DIR)/public.crt

# Color output
BLUE := \033[0;34m
GREEN := \033[0;32m
YELLOW := \033[0;33m
RED := \033[0;31m
NC := \033[0m # No Color

# User/Group env vars
UID := $(shell id -u)
GID := $(shell id -g)

# Docker Compose files
LOCAL_COMPOSE := docker-compose.yml
DEV_COMPOSE := docker-compose.dev.yml
PROD_COMPOSE := docker-compose.prod.yml

# Targets
.PHONY: images install certs bash fix-permissions \ frontend-install frontend-dev frontend-build frontend-bash \ dev up down artisan composer logs dev-up dev-down dev-build dev-restart dev-logs dev-ps dev-clean dev-fix-permissions dev-composer-install dev-npm-install dev-npm-build dev-copy-frontend dev-artisan dev-artisan-migrate dev-artisan-seed dev-setup dev-deploy dev-deploy-fast \ prod-up prod-down prod-build prod-restart prod-logs prod-ps prod-fix-permissions prod-composer-install prod-build-frontend prod-copy-frontend prod-artisan prod-artisan-migrate prod-artisan-seed prod-composer prod-setup prod-deploy prod-deploy-fast prod-ssl-renew

###### Local #######
images:
	@docker compose -f $(LOCAL_COMPOSE) build

install:
	docker compose -f $(LOCAL_COMPOSE) run --rm -u "$(UID):$(GID)" app composer install && \
	cp .env.example .env && \
	docker compose -f $(LOCAL_COMPOSE) run --rm -u "$(UID):$(GID)" app php artisan key:generate

certs:
	@if [ -f $(SSL_KEY) ] && [ -f $(SSL_CERT) ]; then \
		echo "SSL certificate already exists:"; \
		echo "   → $(SSL_KEY)"; \
		echo "   → $(SSL_CERT)"; \
	else \
		mkdir -p $(SSL_DIR); \
		openssl req -x509 -nodes -days 365 \
			-newkey rsa:2048 \
			-keyout $(SSL_KEY) \
			-out $(SSL_CERT) \
			-subj "/C=OM/ST=Muscat/L=Oman/O=AI/CN=localhost"; \
		echo "✅ SSL certificate generated."; \
	fi

bash:
	docker compose -f $(LOCAL_COMPOSE) run --rm -u "${UID}:${GID}" app bash

fix-permissions:
	@docker compose -f $(LOCAL_COMPOSE) run --rm -u "$(UID):$(GID)" app /var/www/html/docker/php/fix-permissions.sh

# Frontend commands
frontend-install:
	@echo "📦 Installing frontend dependencies..."
	@docker compose -f $(LOCAL_COMPOSE) run --rm -u "${UID}:${GID}" frontend npm install
	@echo "✅ Frontend dependencies installed!"

frontend-dev:
	@echo "🚀 Starting frontend dev server..."
	@docker compose -f $(LOCAL_COMPOSE) up frontend -d
	@echo "✅ Frontend running at http://localhost:5173"

frontend-build:
	@echo "🏗️ Building frontend for production..."
	@docker compose -f $(LOCAL_COMPOSE) run --rm -u "${UID}:${GID}" frontend npm run build
	@echo "✅ Frontend built!"

frontend-bash:
	@docker compose -f $(LOCAL_COMPOSE) run --rm -u "${UID}:${GID}" frontend sh

# Full stack commands
dev:
	@echo "🚀 Starting all services..."
	@docker compose -f $(LOCAL_COMPOSE) up -d
	@echo "✅ Backend: http://localhost:8080"
	@echo "✅ Frontend: http://localhost:5173"

# Docker management
up:
	@echo "🚀 Starting all services..."
	@docker compose -f $(LOCAL_COMPOSE) up -d
	@echo "✅ All services started!"

down:
	@echo "🛑 Stopping all services..."
	@docker compose -f $(LOCAL_COMPOSE) down
	@echo "✅ All services stopped!"

logs:
	@docker compose -f $(LOCAL_COMPOSE) logs -f

artisan:
	@docker compose run --rm -u "$(UID):$(GID)" app php artisan $(filter-out $@,$(MAKECMDGOALS))

composer:
	@docker compose run --rm -u "$(UID):$(GID)" app composer $(filter-out $@,$(MAKECMDGOALS))
