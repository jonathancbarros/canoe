SHELL=/bin/bash

run:
	@docker-compose up -d
	@docker exec canoe mkdir -p var/www/vendor
	@docker exec canoe chmod -R 777 var/
	@docker exec canoe cp .env.example .env
	@docker exec canoe php artisan key:generate
	@make run-composer-install
	@make run-migrations

run-composer-install:
	@docker exec canoe composer install

run-migrations:
	@docker exec canoe php artisan config:cache
	@docker exec canoe php artisan migrate:fresh --seed
