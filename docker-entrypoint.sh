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
if [ -z "$(grep '^APP_KEY=' .env)" ] || [ "$(grep '^APP_KEY=' .env | cut -d'=' -f2)" == "" ]; then
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

# Ejecutar migraciones en orden
log "Running migrations..."
php artisan migrate:fresh --force --seed

# Limpiar configuración inicial
log "Clearing initial configuration..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Crear enlaces simbólicos de storage
log "Creating storage link..."
php artisan storage:link || true

# Instalar Filament Shield de forma no interactiva
log "Installing Filament Shield..."
php artisan shield:install --fresh --no-interaction

# Crear superadmin si no existe
log "Setting up admin user..."
php artisan tinker --execute="
try {
    if (! \App\Models\User::where('email', 'admin@example.com')->exists()) {
        \$user = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
            'email_verified_at' => now()
        ]);
        \$user->assignRole('super_admin');
        echo 'Admin user created successfully\n';
    } else {
        echo 'Admin user already exists\n';
    }
} catch (\Exception \$e) {
    echo 'Error creating admin user: ' . \$e->getMessage() . '\n';
}"

# Verificar archivos clave
log "Verifying key files..."
for file in public/.htaccess public/index.php bootstrap/app.php; do
    if [ ! -f "/var/www/html/$file" ]; then
        log "Error: Missing required file $file"
        exit 1
    fi
done

# Limpiar y optimizar después de toda la configuración
log "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Verificar permisos una última vez
log "Final permission check..."
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

log "Application setup completed"

# Iniciar Apache en primer plano
log "Starting Apache..."
exec apache2-foreground
