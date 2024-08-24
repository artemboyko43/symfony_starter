# Vars

DOCKER_COMPOSE = docker-compose -f ./docker/docker-compose.yml
DOCKER_COMPOSE_PHP_FPM_EXEC = ${DOCKER_COMPOSE} exec -u www-data php

# Docker compose

build:
	${DOCKER_COMPOSE} build

start:
	${DOCKER_COMPOSE} start

stop:
	${DOCKER_COMPOSE} stop

up:
	${DOCKER_COMPOSE} up -d --remove-orphans

down:
	${DOCKER_COMPOSE} down

restart: stop start
rebuild: down build up

# App

php:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bash

test:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/phpunit

cache:
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console cache:clear
	${DOCKER_COMPOSE_PHP_FPM_EXEC} bin/console cache:clear --env=test