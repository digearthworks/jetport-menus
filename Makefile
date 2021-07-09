#!make

-include .env

.PHONY: test share build

SHELL := /bin/bash
PHP := vendor/bin/sail
COMPOSER := vendor/bin/sail composer
PHPUNIT := vendor/bin/phpunit

APP_NAME=laravel-turbine

DOWNLOAD_CMD := curl -s https://laravel.build/$(APP_NAME)

INSTALL_CMD = $(SHELL) installer.bash

BUILD_DIR := $(APP_NAME)

define NEWLINE

endef

download_installer:
	$(shell cat .env > installer.bash)
	$(shell echo $(NEWLINE) >> installer.bash)
	$(DOWNLOAD_CMD) >> installer.bash

test:
	cd $(BUILD_DIR) && $(PHPUNIT)

share:
	ngrok http "localhost:8000"

build:
	$(INSTALL_CMD)
	cp dependencies.txt $(BUILD_DIR)
	cp -prv .github $(BUILD_DIR)
	cd $(BUILD_DIR); $(PHP) down; $(PHP) up -d; \
	for pkg in $(shell cat dependencies.txt);\
		do $(COMPOSER) require $${pkg} --no-interaction; \
	done

install:
	cd $(BUILD_DIR); \
	$(PHP) artisan jetstream:install livewire; \
	$(PHP) artisan vendor:publish --tag=jetstream-views -n; \
	$(PHP) artisan vendor:publish --tag=passport-migrations -n; \
	$(PHP) artisan vendor:publish --tag=fortify-migrations -n; \
	$(PHP) artisan vendor:publish --tag=jetstream-migrations -n; \
	$(PHP) artisan vendor:publish --tag=jetstream-routes -n; \
	$(PHP) artisan vendor:publish --tag=log-viewer-config -n; \
	$(PHP) artisan vendor:publish --tag=log-viewer-views -n; \
	$(PHP) artisan vendor:publish --tag=adminer -n; \
	$(PHP) artisan vendor:publish --tag=activitylog-migrations -n; \
	$(PHP) artisan vendor:publish --provider=Spatie\Permission\PermissionServiceProvider; \
	$(PHP) artisan vendor:publish --provider=Spatie\EloquentSortable\EloquentSortableServiceProvider; \
	$(PHP) artisan vendor:publish --provider="HeaderX\Iframes\IframesServiceProvider" --tag="iframes-views"; \
	$(PHP) artisan vendor:publish --provider="HeaderX\Iframes\IframesServiceProvider" --tag="iframes-config"; \
	$(PHP) artisan vendor:publish --provider="HeaderX\LegacyLoader\LegacyLoaderServiceProvider" --tag="legacy-loader-config"; \
	$(PHP) artisan vendor:publish --provider="HeaderX\BukuIcons\BukuIconsServiceProvider"; \
	$(PHP) artisan vendor:publish --provider="HeaderX\AdminerPlugin\AdminerPluginServiceProvider" --tag="adminer-plugins-config"; \
	$(PHP) artisan vendor:publish --tag=impersonate; \
	$(PHP) artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"; \
	$(PHP) artisan vendor:publish --provider="HeaderX\JetstreamPassport\JetstreamPassportServiceProvider" --tag="jetstream-passport-views"; \
	$(PHP) artisan jetstream:install livewire; \
	$(PHP) artisan jetstream-passport:install

default: download_installer

list_dependencies:
	composer show --name-only -D > dependencies.txt

clean_build:
	rm -rf $(BUILD_DIR)

clean_git:
	git reset --hard && git clean -df

clean_deps:
	rm -rf vendor
	rm -rf node_modules

clean:
	$(MAKE) clean_build
	$(MAKE) clean_git
	$(MAKE) clean_deps