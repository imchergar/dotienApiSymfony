FROM php:8.2-apache

WORKDIR /var/www/html

# install dependencies
RUN apt-get update \
    && apt-get install -y curl apt-transport-https ca-certificates gnupg \
    && apt-get update \
    && apt-get install -y git zip libicu-dev zlib1g-dev g++ libpng-dev

# install php extensions
RUN docker-php-ext-install pdo pdo_mysql bcmath \
    && docker-php-ext-configure intl && docker-php-ext-install intl

RUN docker-php-ext-install gd

#install xdebug
RUN pecl install xdebug-3.3.1 \
    && docker-php-ext-enable xdebug \
    && echo "\
xdebug.mode=debug,develop \n\
xdebug.client_host=host.docker.internal \n\
xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN rm -f /etc/php/conf.d/xdebug.ini.template

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install symfony
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install symfony-cli -y

# enable apache2 modules
RUN a2enmod rewrite
