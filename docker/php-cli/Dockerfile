FROM php:7.1.2-cli

MAINTAINER Patricia Frias <patriciafm4@gmail.com>

# Install dependencies
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libicu-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libmemcached-dev \
    zlib1g-dev

# install extensions
RUN docker-php-ext-install \
    json \
    pdo_mysql \
    zip

# install pecl extensions
RUN pecl install \
    apcu-beta \
    memcached \
    xdebug

# configure xdebug extension
COPY ./xdebug.ini /tmp/
RUN cat /tmp/xdebug.ini >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && rm -f /tmp/xdebug.ini

# enable pecl extensions
RUN docker-php-ext-enable \
    apcu \
    memcached \
    xdebug

# install symfony installer tool
RUN curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony \
    && chmod a+x /usr/local/bin/symfony
