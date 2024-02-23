DOCKER_PROJECT=haji-symfony-users

create-network:
	docker network ls | grep "haji-symfony-demo" > /dev/null || docker network create --driver=bridge "haji-symfony-demo"

start-core:
	docker-compose -p "$(DOCKER_PROJECT)-core" -f docker-compose.yml up -d --build

stop-core:
	docker-compose -p "$(DOCKER_PROJECT)-core" -f docker-compose.yml stop

rm-core:
	docker-compose -p "$(DOCKER_PROJECT)-core" -f docker-compose.yml down

start-users:
	docker-compose -p "$(DOCKER_PROJECT)-users" -f docker-compose-user.yaml up -d --build

stop-users:
	docker-compose -p "$(DOCKER_PROJECT)-users" -f docker-compose-user.yaml stop

rm-users:
	docker-compose -p "$(DOCKER_PROJECT)-users" -f docker-compose-user.yaml down

start-notifications:
	docker-compose -p "$(DOCKER_PROJECT)-notifications" -f docker-compose-notification.yaml up -d --build

stop-notifications:
	docker-compose -p "$(DOCKER_PROJECT)-notifications" -f docker-compose-notification.yaml stop

rm-notifications:
	docker-compose -p "$(DOCKER_PROJECT)-notifications" -f docker-compose-notification.yaml down

start-all:
	make start-core
	make start-users
	make start-notifications

stop-all:
	make stop-core
	make stop-users
	make stop-notifications

rm-all:
	make rm-core
	make rm-users
	make rm-notifications

