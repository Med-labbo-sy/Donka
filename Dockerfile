FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip libicu-dev libpng-dev libjpeg-dev \
    libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl mbstring gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader --no-scripts

RUN php artisan key:generate --force

RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

EXPOSE 80

CMD php artisan migrate --force && apache2-foreground
