dockerCompose := "docker compose -f docker-compose.development.yml"
containerRun  := dockerCompose + " run --rm php-fpm"

install:
    composer install

start:
    {{dockerCompose}} up -d

stop:
    {{dockerCompose}} down

test +ARGS="":
    {{containerRun}} vendor/bin/phpunit {{ARGS}}

test-filter FILTER="" +ARGS="":
    {{containerRun}} vendor/bin/phpunit --filter "{{FILTER}}" {{ARGS}}

lint:
    {{containerRun}} vendor/bin/phpmd src text phpmd.xml
    {{containerRun}} vendor/bin/phpcs src

build ENV="development":
    DOCKER_BUILDKIT=1 COMPOSE_DOCKER_CLI_BUILD=1 docker compose -f docker-compose.{{ENV}}.yml build --pull