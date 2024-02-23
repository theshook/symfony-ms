CONTAINER=haji-symfony-demo-notifications

terminal: # Terminal
	docker exec -it $(CONTAINER) bash

database: # Create database (run only once)
	docker exec -it $(CONTAINER) sh -c "php bin/console doctrine:database:create"

migrate:
	docker exec -it $(CONTAINER) sh -c "php bin/console doctrine:migrations:migrate --no-interaction"