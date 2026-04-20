FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
ENV APP_ENV=prod
ENV APP_DEBUG=0
RUN composer install --no-dev --optimize-autoloader --no-scripts
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
RUN a2dismod mpm_event && a2enmod mpm_prefork
CMD doctrine:fixtures:load --no-interaction ; apache2-foreground