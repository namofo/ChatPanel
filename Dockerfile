# Etapa 1: Construcción
FROM composer:2.6 AS build
WORKDIR /var/www/html

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl && \
    docker-php-ext-install zip pdo_mysql

# Instalar dependencias de PHP
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copiar el proyecto al contenedor
COPY . .

# Instalar Filament Shield y configurar Laravel
RUN php artisan shield:install --fresh
RUN php artisan optimize:clear

# Etapa 2: Producción
FROM php:8.2-fpm
WORKDIR /var/www/html

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl && \
    docker-php-ext-install zip pdo_mysql

# Copiar archivos desde la etapa de construcción
COPY --from=build /var/www/html /var/www/html

# Configuración del contenedor
EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

