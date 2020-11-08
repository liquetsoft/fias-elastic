#!/usr/bin/make
# Makefile readme (ru): <http://linux.yaroslavl.ru/docs/prog/gnu_make_3-79_russian_manual.html>
# Makefile readme (en): <https://www.gnu.org/software/make/manual/html_node/index.html#SEC_Contents>

SHELL = /bin/sh

php_container_name := php
user_id := $(shell id -u)
docker_compose_yml := docker/docker-compose.yml

docker_compose_bin := $(shell command -v docker-compose 2> /dev/null) --file "$(docker_compose_yml)"
php_container_bin := $(docker_compose_bin) run --rm -u $(user_id) "$(php_container_name)"

.PHONY : build shell test fixer buildEntities linter
.DEFAULT_GOAL := build

# --- [ Development tasks ] -------------------------------------------------------------------------------------------

build: ## Build container and install composer libs
	$(docker_compose_bin) build
	$(php_container_bin) composer update

shell: ## Runs shell in container
	$(php_container_bin) /bin/bash

test: ## Execute library tests
	$(php_container_bin) vendor/bin/phpunit --configuration phpunit.xml.dist --coverage-html=tests/coverage

fixer: ## Run fixes for code style
	$(php_container_bin) vendor/bin/php-cs-fixer fix -vv

buildEntities: ## Build entities from yaml file with description
	$(php_container_bin) php -f generator/generate_entities.php
	$(php_container_bin) vendor/bin/php-cs-fixer fix -q

linter: ## Run code checks
	$(php_container_bin) vendor/bin/php-cs-fixer fix --config=.php_cs.dist -vv --dry-run --stop-on-violation
	$(php_container_bin) vendor/bin/phpcpd ./src --exclude Entity --exclude Serializer -v
	$(php_container_bin) vendor/bin/psalm --show-info=true
