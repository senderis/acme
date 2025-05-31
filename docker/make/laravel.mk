artisan:
	$(call artisan)
.PHONY: artisan

laravel:
	$(call laravel)
.PHONY: laravel

define artisan
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(eval ARG3 := $(word 3, $(ARGS)))
	$(eval ARG4 := $(word 4, $(ARGS)))
	$(call artisan_exec,$(ARG1),$(ARG2),$(ARG3),$(ARG4))
endef


define artisan_exec
	$(call setup_env,$(ENV_FILE))
	@echo "Executing artisan $(1) $(2) $(3) $(4)"
	@docker exec -it $(CNT) sh -c "./artisan $(1) $(2) $(3) $(4)"

endef

define laravel
	$(call setup_env,$(ENV_FILE))
	$(eval ARGS := $(subst , ,$(RUN_ARGS)))
	$(eval ARG1 := $(word 1, $(ARGS)))
	$(eval ARG2 := $(word 2, $(ARGS)))
	$(eval ARG3 := $(word 3, $(ARGS)))
	$(eval ARG4 := $(word 4, $(ARGS)))
	$(call laravel_exec,$(ARG1),$(ARG2),$(ARG3),$(ARG4))
endef


define laravel_exec
	$(call setup_env,$(ENV_FILE))
	@if [ "$(1)" = "help" ] || [ -z "$(1)" ]; then \
		$(call laravel_exec_help); \
	fi
	@echo "Executing laravel $(1) $(2) $(3) $(4)"
	@docker exec -it $(CNT) sh -c "/root/.config/composer/vendor/bin/laravel $(1) $(2) $(3) $(4)"
endef

define laravel_exec_help
	echo "Available laravel options:" && \
	echo "make laravel" && \
	echo "make laravel [command]" && \
	exit 0
endef
	