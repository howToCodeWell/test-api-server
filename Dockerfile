# Webserver Base
FROM php:8.0.1-apache-buster as webserver-base

LABEL maintainer="Peter Fisher"

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

FROM dev-builder as webserver-dev
COPY --chown=www-data:www-data  . .
RUN mkdir -p var/log && chmod -R 777 var/log

EXPOSE 80

CMD apachectl -D FOREGROUND
