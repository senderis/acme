
define codecept
	$(call setup_env,$(ENV_FILE))
	docker exec -it $(CNT) $(LINUX_CMD_SHELL) "vendor/bin/codecept $(RUN_ARGS)"
endef


define composer
	$(call setup_env,$(ENV_FILE))
	@docker exec -it $(CNT) $(LINUX_CMD_SHELL) "composer $(RUN_ARGS)"
endef 

define codecept
	$(call setup_env,$(ENV_FILE))
	docker exec -it $(CNT) $(LINUX_CMD_SHELL) "vendor/bin/codecept $(RUN_ARGS)"
endef

define codecept_api
	$(call setup_env,$(ENV_FILE))
	docker exec -it $(CNT) $(LINUX_CMD_SHELL) "vendor/bin/codecept run Api"
endef


define composer
	$(call setup_env,$(ENV_FILE))
	@docker exec -it $(CNT) $(LINUX_CMD_SHELL) "composer $(RUN_ARGS)"
endef 

define phpstan
	$(call setup_env,$(ENV_FILE))
	docker exec -it $(CNT) $(LINUX_CMD_SHELL) "vendor/bin/phpstan analyse src"
endef

define phpunit
	$(call setup_env,$(ENV_FILE))
	docker exec -it $(CNT) $(LINUX_CMD_SHELL) "vendor/bin/phpunit $(RUN_ARGS)"
endef

define php-cs-fixer
	$(call setup_env,$(ENV_FILE))
	docker exec -it $(CNT) $(LINUX_CMD_SHELL) "vendor/bin/php-cs-fixer fix src --rules=@PSR12"
endef
