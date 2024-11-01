FROM composer:2.6.6 as composer

################################################################################

FROM php:8.3-fpm-alpine as base

WORKDIR /app/

# Logverzeichnisse erzeugen
RUN chown -R www-data:www-data /app/

RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
&& pecl install redis \
&& docker-php-ext-enable redis.so

# Project dependencies
RUN apk add \
    build-base \
    openssl-dev \
    php-cli \
 && docker-php-ext-install -j$(nproc) opcache pdo pdo_mysql bcmath pcntl \
 && rm -rf \
    /var/cache/apk/* \
    /tmp/pear

# add user
RUN adduser --disabled-password --no-create-home --home /app/ --gecos '' app
WORKDIR /app/
RUN chown -R app:app /app/ \
 && mkdir -p /app/php-file-cache/

################################################################################

FROM base as build

# composer dependencies
RUN apk add git unzip && rm -rf /var/cache/apk/*

# composer kopieren
COPY --from=composer /usr/bin/composer /usr/bin/composer

# composer.json und composer.lock kopieren
COPY composer.* /app/

# composer install
USER app
RUN /usr/bin/composer install --no-progress --no-scripts \
 && composer dump-autoload --optimize \
 && rm -rf \

USER root
################################################################################

FROM build as development

USER root

# xdebug
RUN apk add autoconf gcc build-base linux-headers \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && apk del autoconf gcc build-base
COPY ./docker/php/php-xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
COPY ./docker/php/php-custom-development.ini /usr/local/etc/php/conf.d/custom.ini

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY --chown=app:app --from=build /app /app
COPY --chown=app:app . /app
USER app

################################################################################

FROM base as production
