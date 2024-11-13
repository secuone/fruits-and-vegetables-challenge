# Define container names and services
PHP_CONTAINER_NAME=veggievibe
REDIS_CONTAINER_NAME=redis
DOCKER_COMPOSE=docker-compose

# Default environment is dev, you can override it during execution
ENVIRONMENT ?= dev

default: help

help: # Show help for each of the Makefile recipes.
	@grep -E '^[a-zA-Z0-9 -]+:.*#'  Makefile | sort | while read -r l; do printf "\033[1;32m$$(echo $$l | cut -f 1 -d':')\033[00m:$$(echo $$l | cut -f 2- -d'#')\n"; done

setup: # Build containers with ENVIROMENT (e.g., dev, prod)
	@echo "Setting up containers with APP_ENV=$(ENVIRONMENT)..."
	$(DOCKER_COMPOSE) build --build-arg APP_ENV=$(ENVIRONMENT)

up: # Start the containers
	@echo "Starting containers..."
	$(DOCKER_COMPOSE) up -d

down: # Stop and remove containers
	@echo "Stopping and removing containers..."
	$(DOCKER_COMPOSE) down

restart: # Restart the containers
	@echo "Restarting containers..."
	$(DOCKER_COMPOSE) restart

test: # Run unit tests
	@echo "Running unit tests..."
	docker exec -it $(PHP_CONTAINER_NAME) php bin/phpunit

php-shell: # Get a shell inside the PHP container
	@echo "Entering PHP container..."
	docker exec -it $(PHP_CONTAINER_NAME) /bin/sh

composer-install: # Run composer install inside PHP container
	@echo "Running Composer Install..."
	docker exec -it $(PHP_CONTAINER_NAME) composer install

composer-update: # Run composer update inside PHP container
	@echo "Running Composer Update..."
	docker exec -it $(PHP_CONTAINER_NAME) composer update

composer-dumpauto: # Run composer dump-autoload inside PHP container
	@echo "Running Composer Dump-Autoload..."
	docker exec -it $(PHP_CONTAINER_NAME) composer dump-autoload

clean: # Stop and remove containers, networks, volumes, and images
	@echo "Cleaning up containers, networks, volumes, and images..."
	$(DOCKER_COMPOSE) down --volumes --remove-orphans --rmi all

redis-shell: # Enter Redis container and run a command
	@echo "Entering Redis container..."
	docker exec -it $(REDIS_CONTAINER_NAME) redis-cli

redis-flush: # Flush Redis database (clear all data)
	@echo "Flushing Redis database..."
	docker exec -it $(REDIS_CONTAINER_NAME) redis-cli FLUSHALL

redis-info: # Show Redis information about memory usage, stats, etc.
	@echo "Getting Redis info..."
	docker exec -it $(REDIS_CONTAINER_NAME) redis-cli INFO

redis-check: # Check if Redis is running and responsive
	@echo "Checking Redis status..."
	docker exec -it $(REDIS_CONTAINER_NAME) redis-cli PING
