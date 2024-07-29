.PHONY: start stop restart down key-generate migrate fresh

start:
	@docker-compose up -d

stop:
	@docker-compose stop

restart: stop start

down:
	@docker-compose down

key-generate:
	@docker-compose exec app php artisan key:generate

migrate:
	@docker-compose exec app php artisan migrate

fresh:
	@docker-compose exec app php artisan migrate:fresh --seed
