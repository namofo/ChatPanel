# Usa una imagen oficial de PHP como base
FROM php:8.2-fpm-alpine

# Establece el directorio de trabajo
WORKDIR /var/www

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip

# Copia el archivo composer.lock y composer.json
COPY composer.lock composer.json ./

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instala las dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Copia el resto del código del proyecto
COPY . .

# Ejecuta los comandos de Artisan
RUN php artisan shield:install --fresh --no-interaction \
    && php artisan migrate --force

# Exponer el puerto
EXPOSE 9000

# Comando para ejecutar PHP-FPM
CMD ["php-fpm"]
