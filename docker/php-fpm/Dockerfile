FROM php:8.0-fpm-alpine

#сделать композер доступным внутри контейнера
COPY ./docker/php-fpm/conf.d /usr/local/etc/php/conf.d
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apk update \
    && apk --no-cache upgrade \
    && apk add yaml-dev autoconf make g++ \
    && pecl install yaml-2.2.2 \
    && docker-php-ext-install mysqli pdo pdo_mysql bcmath\
    && docker-php-ext-enable yaml 

#also for ckfinder to get it work
RUN apk add --no-cache libpng libpng-dev \
    && docker-php-ext-install gd \
    && docker-php-ext-enable gd \
    && apk del libpng-dev

#for installing ckfinder via composer
RUN apk add --no-cache libzip-dev zip \
    && docker-php-ext-install zip \
    && docker-php-ext-enable zip


RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

COPY ./docker/php-fpm/entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

#установка debugger
RUN pecl install xdebug-3.1.2 \
    && docker-php-ext-enable xdebug

WORKDIR ./app






