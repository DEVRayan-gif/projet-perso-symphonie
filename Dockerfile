FROM php:8.2-cli
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /app
COPY . .
ENV APP_ENV=prod
ENV APP_DEBUG=0
RUN composer install --no-dev --optimize-autoloader --no-scripts
EXPOSE 8080
CMD php -S 0.0.0.0:$PORT router.php