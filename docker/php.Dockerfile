FROM php:8.1.7-cli-alpine

RUN apk update && apk add curl git wget

RUN docker-php-ext-install sockets

RUN apk add --update --no-cache --virtual .build-dependencies $PHPIZE_DEPS

RUN pecl update-channels

RUN docker-php-ext-install pdo bcmath sockets

RUN docker-php-ext-install opcache  \
    && docker-php-ext-enable opcache

RUN apk add --no-cache yaml-dev  \
    && pecl channel-update pecl.php.net  \
    && pecl install yaml-2.2.2 && docker-php-ext-enable yaml


RUN pecl install pcov  \
    && docker-php-ext-enable pcov

RUN mkdir /var/log/php && chown -R www-data:www-data /var/log/php

WORKDIR /usr/local/etc/php/conf.d/

COPY docker/config/php/php.ini .

WORKDIR /var/www/html

RUN chown -R www-data:www-data /var/www/html

COPY . .

ENTRYPOINT [ "php"]