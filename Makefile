# Setup env to make sure this repository running well in your local environment without Docker
.PHONY: setup
setup:
	@echo "Check available binary PHP, NodeJS"
	@echo "Check OS version to pick installation binary version"
	@echo "Check environment version: PHP, NodeJS. If match, continue to TRUE step"
	@echo "TRUE: Install service dependencies"
	@echo "FALSE: Rework environment dependencies"
	@echo "Running service"

# Update git hook setup
.PHONY: update-commit-rules
update-commit-rules:
	@php vendor/bin/cghooks update

# Migration basic commands, write all here then no need remember all the commands
.PHONY: create-migration
create-migration:
	@php artisan make:migration $(MIGRATION_NAME)

.PHONY: exec-migration
exec-migration:
	@php artisan migrate

.PHONY: check-migration
check-migration:
	@php artisan migrate:status


# Model Name Rules
# Must use UpperCase at first char, e.g: Product, Mahasiswa
.PHONY: create-model
create-model:
	@php artisan make:model $(MODEL_NAME) --migration