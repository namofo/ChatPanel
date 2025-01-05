# Dockerfile
FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    npm

# Instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos del proyecto
COPY . /var/www

# Instalar dependencias
RUN composer install --no-interaction --no-dev --optimize-autoloader
RUN npm install && npm run build

# Configurar permisos
RUN chmod -R 777 storage bootstrap/cache

# Exponer puerto
EXPOSE 8000

# Iniciar servidor
CMD php artisan serve --host=0.0.0.0 --port=8000