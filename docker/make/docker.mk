define build
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(call build_exec,$(ARG1),$(ARG2))
endef


define build_exec
	@if [ "$(1)" = "help" ] || [ -z "$(1)" ]; then \
		echo "Available build options:"; \
		echo "php, mysql,nginx"; \
		exit 0; \
		elif [ "$(1)" != "all" ] && [ -n "$(1)" ]; then \
			echo "Building with arguments: $(1) ${COMPOSE_FILE}" ; \
			docker compose build --build-arg platform=$(PLATFORM) $(1); \
		else \
			echo "Building all containers"; \
			if [ "$(1)" = "all" ]; then \
				echo "Building all container(s)"; \
				make build php; \
			fi; \
	fi
endef


define down
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(call down_exec,$(ARG1),$(ARG2))
endef


define down_exec

	@if [ "$(1)" = "help" ]; then \
		echo "Available down options:"; \
		echo "down [container] - stop one container"; \
		echo "down -all containers"; \
		exit 0; \
		elif [ -z "$(1)" ]; then \
			echo "Stop all containers"; \
			docker compose -p $(PROJECT_NAME) down ; \
		elif [ -n "$(1)" ]; then \
			echo "Down one profile: $(1)"; \
			docker compose -p $(PROJECT_NAME) down $(1); \
		else \
			echo "Available down options:"; \
			echo "down [container] - stop one container"; \
			echo "down -all containers"; \
			exit 0; \
	fi
endef


define list
	@LC_ALL=C $(MAKE) -pRrq -f $(firstword $(MAKEFILE_LIST)) : 2>/dev/null | awk -v RS= -F: '/(^|\n)# Files(\n|$$)/,/(^|\n)# Finished Make data base/ {if ($$1 !~ "^[#.]") {print $$1}}' | sort | grep -E -v -e '^[^[:alnum:]]' -e '^$@$$'
endef

define container_log
	$(call setup_env,$(ENV_FILE))
	@if [ "$(RUN_ARGS)" = "help" ] || [ -z "$(RUN_ARGS)" ]; then \
		echo "Available log options:" ; \
		echo "php, nginx, mysql" ; \
		exit 0; \
	else \
		docker logs -f $(RUN_ARGS); \
	fi
endef

define mount
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(call mount_exec,$(ARG1),$(ARG2))
endef


define mount_exec
	$(call setup_env,$(ENV_FILE))
	@if [ "$(1)" = "help" ] || [ -z "$(1)" ]; then \
		echo "Available mount options:"; \
		echo "mount [container]"; \
		exit 0; \
		else \
			echo "mount profile: $(1)"; \
			docker exec -it $(1) $(LINUX_SHELL); \
	fi
endef



define up
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(call up_exec,$(ARG1),$(ARG2))
endef

define up_exec

	@if [ "$(1)" = "help" ]; then \
		echo "Available run options:"; \
		echo "up [container] - one container"; \
		echo "up -all containers"; \
		exit 0; \
		elif [ -z "$(1)" ]; then \
			echo "Run all containers"; \
			docker compose -p $(PROJECT_NAME) up -d ; \
		elif [ -n "$(1)" ]; then \
			echo "Up one profile: $(1)"; \
			docker compose -p $(PROJECT_NAME) up -d ; \
		else \
			echo "Available run options:"; \
			echo "up [container] - one container"; \
			echo "up -all containers"; \
			exit 0; \
	fi
endef

define restart
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(call restart_exec,$(ARG1),$(ARG2))
endef

define restart_exec
	@if [ "$(1)" = "help" ]; then \
		echo "Available restart options:"; \
		echo "restart [container] - restart one container"; \
		echo "restart -all containers"; \
		exit 0; \
	elif [ -z "$(1)" ]; then \
		echo "Restarting all containers"; \
		docker compose -p $(PROJECT_NAME) down ; \
		docker compose -p $(PROJECT_NAME) up -d ; \
	else \
		echo "Available restart options:"; \
		echo "restart -all containers"; \
		exit 0; \
	fi
endef



# Catch-all rule to handle undefined targets
%:
	@if [ "$(DEBUG_MAKE_FILE)" = "true" ]; then \
		echo "Warning: Target '$@' is not defined in the Makefile."; \
	fi
	@exit 0
