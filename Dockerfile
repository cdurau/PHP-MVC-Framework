FROM php:8.0.3-apache-buster
RUN docker-php-ext-install pdo pdo_mysql && a2enmod rewrite
RUN chmod 755 -R /var/www/html