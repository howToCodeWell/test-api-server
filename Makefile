up:
	docker-compose up -d
down:
	docker-compose down
stop:
	docker-compose stop
build:
	docker-compose build
remove:
	docker-compose down --rmi='all' --volumes
vendor-install:
	docker-compose exec api-test-server composer install
vendor-update:
	docker-compose exec api-test-server composer update
vendor-update-dry-run:
	docker-compose exec api-test-server composer update --dry-run

static-analysis:
	docker-compose exec api-test-server bin/phpstan analyse

test-unit:
	docker-compose exec api-test-server bin/codecept run unit

test: static-analysis test-unit

install: build up vendor-install test
uninstall: down remove
