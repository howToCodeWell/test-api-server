up:
	docker-compose up -d
down:
	docker-compose down
stop:
	docker-compose stop
build:
	docker-compose build
remove:
	docker-compose down --rmi='local' --volumes
vendor-install:
	docker-compose exec api-test-server composer install
vendor-update:
	docker-compose exec api-test-server composer update
vendor-update-dry-run:
	docker-compose exec api-test-server composer update --dry-run

code-style:
	docker-compose exec api-test-server bin/phpcbf src
mess-detector:
	docker-compose exec api-test-server bin/phpmd src ansi ./ruleset.xml
static-analysis:
	docker-compose exec api-test-server bin/phpstan analyse

test-unit:
	docker-compose exec api-test-server bin/codecept run unit

test: code-style static-analysis test-unit

install: build up vendor-install
uninstall: down remove
