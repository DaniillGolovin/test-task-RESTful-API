SHELL := /bin/bash

setup: env-prepare install-app key

install-app:
	composer install
	composer dump-autoload -o

env-prepare:
	cp -n .env.example .env || true

key:
	php artisan key:generate

# Docker
compose: compose-clear compose-build compose-start

compose-clear:
	docker compose down -v --remove-orphans || true

compose-build:
	docker compose build

compose-start:
	docker compose up -d

compose-setup: compose-storage-fix compose-db-prepare

compose-app-bash:
	docker exec -it example_name_app bash

compose-db-prepare:
	php artisan migrate:fresh --seed

compose-storage-fix:
	chmod -R 777 storage/
