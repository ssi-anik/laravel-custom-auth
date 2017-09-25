FROM php:7.1.1-fpm

RUN apt-get update && apt-get install -y libmcrypt-dev curl nano

RUN docker-php-ext-install mcrypt pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer