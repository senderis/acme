SHELL := /bin/bash
LINUX_SHELL ?=/bin/bash
LINUX_CMD_SHELL ?=/bin/bash -c
ENV_FILE =.env
RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
CNT=php
COMPOSE_FILE=docker-compose.yml
SLEEP=2
DEBUG_MAKE_FILE=false

define setup_env
	$(shell test ! -f $(1) && echo $(pwd)/assets/compose/$(ENV_FILE) file does not exist && exit)
	$(eval ENV_FILE := $(1))
	$(eval include $(1))
	$(eval export sed 's/=.*//' $(1))
	$(call setup_compose_file)
endef

define env
	$(call setup_env,$(ENV_FILE))
endef

include make/basic.mk
include make/commands.mk
include make/docker.mk
include make/symfony.mk
include make/laravel.mk
include make/cake.mk

commands:
	$(call commands)
.PHONY: commands

help:
	$(call commands)
.PHONY: help

### DOCKER COMMANDS ###

build:
	$(call build )
.PHONY: build

down:
	$(call down)
.PHONY: down

### BASIC COMMANDS ###

env:
	$(call env)
.PHONY: env

clean:
	$(call clean_mysql)
.PHONY: clean

codecept:
	$(call codecept)
.PHONY: codecept

console:
	$(call console)
.PHONY: console

composer:
	$(call composer)
.PHONY: composer

dump:
	$(call dump_mysql)
.PHONY: dump


log:
	$(call container_log)
.PHONY: log


import:
	$(call import_mysql)
.PHONY: import



npm:
	$(call npm)
.PHONY: npm

mount:
	$(call mount)
.PHONY: mount

test:
	$(call phpunit)
	$(call codecept_api)
.PHONY: test

test/unit:
	$(call phpunit)
.PHONY: test/unit

test/api:
	$(call codecept_api)
.PHONY: test/api

phpstan:
	$(call phpstan)
.PHONY: phpstan

php-cs-fixer:
	$(call php-cs-fixer)
.PHONY: php-cs-fixer

phpunit:
	$(call phpunit)	
.PHONY: phpunit


### ADVANCED COMMANDS ###



restart:
		$(call restart)
.PHONY: restart

up:	
	$(call up)
.PHONY: up