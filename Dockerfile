FROM php:8.0.1-apache-buster
RUN docker-php-ext-install pdo pdo_mysql
