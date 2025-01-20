#!/bin/bash

set -e

echo "Starting initialization process..."

# Función para logging
log() {
    echo "[$(date -u)] $1"
}

# Verificar permisos y directorios necesarios
log "Checking and setting up directories..."
for dir in storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache; do
    mkdir -p /var/www/html/$dir
    chmod -R 775 /var/www/html/$dir
    chown -R www-data:www-data /var/www/html/$dir
done

# Generar APP_KEY si no existe
log "Checking APP_KEY..."
if [ -z "$APP_KEY" ]; then
    log "Generating new APP_KEY..."
    php artisan key:generate --force
fi

# Esperar a que MySQL esté disponible
log "Waiting for database connection..."
max_tries=30
count=0
until php artisan db:show >/dev/null 2>&1; do
    count=$((count + 1))
    if [ $count -gt $max_tries ]; then
        log "Error: Could not connect to database after $max_tries attempts"
        exit 1
    fi
    log "Database not ready... waiting (attempt $count/$max_tries)"
    sleep 2
done
log "Database connection established"

# Ejecutar migraciones
log "Running migrations..."
php artisan migrate --force

# Ejecutar seeders
log "Running seeders..."
php artisan db:seed --force

# Limpiar y optimizar
log "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Crear enlaces simbólicos de storage
log "Creating storage link..."
php artisan storage:link || true

# Instalar Filament Shield
log "Installing Filament Shield..."
php artisan shield:install --fresh --no-interaction

# Configurar Apache para escuchar en el puerto correcto de Railway
log "Configuring Apache..."
sed -i "s/Listen 80/Listen ${PORT:-80}/g" /etc/apache2/ports.conf
sed -i "s/:80/:${PORT:-80}/g" /etc/apache2/sites-enabled/000-default.conf

# Iniciar Apache en primer plano
log "Starting Apache..."
apache2-foreground
