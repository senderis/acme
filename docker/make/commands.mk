


define commands
	@echo "=== Available commands: ==="
	@echo make build 	    - build containers
	@echo make build all	- build all containers
	@echo make composer 	- run composer
	@echo make down 	    - stop and remove containers
	@echo make mount 	    - mount a container
	@echo make setup 	    - install application
	@echo make uninstall 	- uninstall application
	@echo make up 		    - start docker containers
	@echo make php-cs-fixer - run php-cs-fixer
	@echo make phpstan 	    - run phpstan
	@echo make phpunit 	    - run phpunit
endef

#simple install command has conflict with composer install command
setup:
	$(call setup)
.PHONY: install

uninstall:
	$(call uninstall_application)
.PHONY: uninstall


define setup
	$(call setup_env,$(ENV_FILE))
	@set -a && source $(ENV_FILE) && set +a
	@echo "=== Setting Up Application: ==="
	@echo "Building all containers"
	make build all
	@sleep $(SLEEP)
	@echo "=== Starting container(s) ==="
	@make up
	@echo "=== Installing composer packages ==="
	@sleep $(SLEEP)
	@make composer install
	@echo ""
	@echo "=== Please execute next commands: ===" 
	@echo "  - make phpunit      - to run tests"
	@echo "  - make phpstan      - to run phpstan"
	@echo "  - make php-cs-fixer - to run php-cs-fixer"

endef	

define uninstall_application
	@echo "=== Uninstall Application: ==="
	$(call down)
	@set -a
	$(call setup_env,$(ENV_FILE))
	@echo === Remove project images ===
	@sleep $(SLEEP)
	@if [ -z "$(PROJECT_NAME)" ]; then \
		echo "PROJECT_NAME is not set"; \
		exit 1; \
	fi
	@docker images -q ${PROJECT_NAME}* | xargs -r docker rmi -f
	@echo === Remove project volumes ===
	@sleep $(SLEEP)
	@docker volume ls -q | grep ${PROJECT_NAME} | xargs -r docker volume rm -f
	@echo === Uninstall was successful ===
endef	
