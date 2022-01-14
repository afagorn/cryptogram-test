init: dc-down-clear dc-build dc-up composer-install rsa-generate
rebuild: dc-down dc-build dc-up
up: dc-up
restart: dc-down dc-up
down: dc-down

#docker management
dc-up:
	docker-compose up -d
dc-down:
	docker-compose down --remove-orphans
dc-down-clear:
	docker-compose down -v --remove-orphans
dc-logs:
	docker-compose logs -f
dc-build:
	docker-compose build

composer-install:
	docker-compose run --rm php-cli composer install
rsa-generate:
	docker-compose run --rm php-cli php artisan rsa:generate
