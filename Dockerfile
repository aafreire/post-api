FROM php:7.1-apache
MAINTAINER aa.santos8147@gmail.com

RUN apt-get update
RUN apt-get install -y apt-utils
RUN apt-get install -y vim
RUN apt-get install -y unzip git
RUN docker-php-ext-install pdo pdo_mysql
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN composer install --no-interaction

COPY postapi.dev.conf /etc/apache2/sites-available/postapi.dev.conf

RUN a2ensite postapi.dev.conf
RUN a2enmod rewrite
RUN service apache2 reload

EXPOSE 80
EXPOSE 443