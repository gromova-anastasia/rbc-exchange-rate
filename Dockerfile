FROM php:7.4-fpm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/rbc-exchange-rate

COPY . .

RUN composer install

RUN chown -R www-data:www-data /var/www/html

EXPOSE 9000
