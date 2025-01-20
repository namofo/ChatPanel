FROM php:8.2-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libicu-dev \
    net-tools

# Configurar e instalar extensiones PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl

# Configurar PHP
RUN { \
    echo 'display_errors = On'; \
    echo 'display_startup_errors = On'; \
    echo 'error_reporting = E_ALL'; \
    echo 'log_errors = On'; \
    echo 'error_log = /dev/stderr'; \
    echo 'memory_limit = 256M'; \
    echo 'post_max_size = 50M'; \
    echo 'upload_max_filesize = 50M'; \
} > /usr/local/etc/php/conf.d/custom.ini

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Configurar virtual host de Apache
RUN { \
    echo '<VirtualHost *:80>'; \
    echo '  ServerAdmin webmaster@localhost'; \
    echo '  DocumentRoot ${APACHE_DOCUMENT_ROOT}'; \
    echo '  DirectoryIndex index.php index.html'; \
    echo '  ErrorLog ${APACHE_LOG_DIR}/error.log'; \
    echo '  CustomLog ${APACHE_LOG_DIR}/access.log combined'; \
    echo '  LogLevel debug'; \
    echo '  <Directory ${APACHE_DOCUMENT_ROOT}>'; \
    echo '    Options Indexes FollowSymLinks'; \
    echo '    AllowOverride All'; \
    echo '    Require all granted'; \
    echo '    <IfModule mod_rewrite.c>'; \
    echo '      RewriteEngine On'; \
    echo '      RewriteCond %{REQUEST_FILENAME} !-d'; \
    echo '      RewriteCond %{REQUEST_FILENAME} !-f'; \
    echo '      RewriteRule ^ index.php [L]'; \
    echo '    </IfModule>'; \
    echo '  </Directory>'; \
    echo '</VirtualHost>'; \
} > /etc/apache2/sites-available/000-default.conf

# Configurar ServerName
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Habilitar módulos de Apache necesarios
RUN a2enmod rewrite headers

# Establecer directorio de trabajo
WORKDIR /var/www/html

# Copiar archivos del proyecto
COPY . .

# Crear archivo .env desde .env.example si existe, o crear uno nuevo
RUN if [ -f ".env.example" ]; then \
        cp .env.example .env; \
    else \
        touch .env && \
        echo "APP_NAME=Laravel" >> .env && \
        echo "APP_ENV=production" >> .env && \
        echo "APP_DEBUG=true" >> .env && \
        echo "APP_URL=http://localhost" >> .env && \
        echo "LOG_LEVEL=debug" >> .env && \
        echo "DB_CONNECTION=mysql" >> .env; \
    fi

# Instalar dependencias
RUN composer install --no-interaction --no-dev --optimize-autoloader && \
    composer require fakerphp/faker

# Configurar permisos
RUN chown -R www-data:www-data /var/www/html && \
    find /var/www/html -type f -exec chmod 644 {} \; && \
    find /var/www/html -type d -exec chmod 755 {} \; && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Script de inicio
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
