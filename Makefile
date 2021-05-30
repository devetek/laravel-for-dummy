# Setup env to make sure this repository running well in your local environment without Docker
.PHONY: setup
setup:
	@echo "Check available binary PHP, NodeJS"
	@echo "Check OS version to pick installation binary version"
	@echo "Check environment version: PHP, NodeJS. If match, continue to TRUE step"
	@echo "TRUE: Install service dependencies"
	@echo "FALSE: Rework environment dependencies"
	@composer update
	@npm install
	@echo "Running service"

# Model/Migration basic commands, write all here then no need remember all the commands
.PHONY: create-model
create-model:
	@php artisan make:model $(MODEL_NAME) --migration
	@php artisan make:controller $(MODEL_NAME)Controller --resource --model=$(MODEL_NAME)

.PHONY: exec-migration
exec-migration:
	@php artisan migrate

.PHONY: check-migration
check-migration:
	@php artisan migrate:status

# Update git hook setup
.PHONY: update-commit-rules
update-commit-rules:
	@php vendor/bin/cghooks update