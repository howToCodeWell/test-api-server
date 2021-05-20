# Webserver Base
FROM php:8.0.1-apache-buster as webserver-base

LABEL maintainer="Peter Fisher"

ARG APP_ENV=prod
ENV APP_ENV=$APP_ENV
ARG DEBIAN_FRONTEND=noninteractive
ENV APACHE_DOCUMENT_ROOT="/var/www/html/public"
RUN apt-get update --fix-missing \
    && apt-get install -y --no-install-recommends zlib1g-dev libcurl3-dev libssl-dev \
    && docker-php-ext-install iconv \
    && a2enmod rewrite \
    && a2enmod headers

RUN apt-get clean autoclean \
    && apt-get autoremove --yes \
    && rm -rf /var/lib/{apt,dpkg,cache,log}/

FROM webserver-base as dev-builder
RUN apt-get install -y --no-install-recommends  \
    zip unzip libzip-dev curl \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip  \
    && curl -sS https://getcomposer.org/installer | php -- \
                                                    --install-dir=/usr/local/bin \
                                                    --filename=composer

RUN pecl install xdebug-3.0.0 && docker-php-ext-enable xdebug

FROM dev-builder as webserver-dev
COPY composer.json .
COPY composer.lock .
RUN composer install --optimize-autoloader

COPY --chown=www-data:www-data  . .
COPY ./apache2/config/${APP_ENV}/sites-available/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./apache2/config/${APP_ENV}/php/apache2/php.ini /usr/local/etc/php/php.ini
COPY ./apache2/scripts/docker-entrypoint.sh /

RUN mkdir -p var/log \
    && mkdir -p var/cache \
    && chown www-data:www-data -Rf var/log \
    && chown www-data:www-data -Rf var/cache \
    && chmod +x /docker-entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/docker-entrypoint.sh"]
