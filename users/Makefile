CONTAINER=haji-symfony-demo-users

terminal: # Terminal
	docker exec -it $(CONTAINER) bash

database: # Create database (run only once)
	docker exec -it $(CONTAINER) sh -c "php bin/console doctrine:database:create"

migrate:
	docker exec -it $(CONTAINER) sh -c "php bin/console doctrine:migrations:migrate --no-interaction"

run-tests: ## Run all tests
	docker exec -it $(CONTAINER) sh -c "./vendor/bin/phpunit"