SHELL=/bin/bash

run:
	@docker-compose up -d
	@docker exec canoe composer install
	@docker exec canoe php artisan migrate:fresh --seed
