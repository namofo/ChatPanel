#!/bin/bash

# Configurar permisos de storage y cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Generar APP_KEY si no existe
php artisan key:generate --force

# Limpiar configuración inicial
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Esperar a que MySQL esté disponible
echo "Waiting for database connection..."
until php artisan db:show >/dev/null 2>&1; do
  echo "Database not ready... waiting"
  sleep 2
done
echo "Database connection established"

# Ejecutar migraciones en orden
echo "Running migrations..."
php artisan migrate:fresh --force --seed

# Crear enlaces simbólicos de storage
echo "Creating storage link..."
php artisan storage:link

# Instalar Filament Shield
echo "Installing Filament Shield..."
php artisan shield:install --fresh

# Crear superadmin si no existe
echo "Setting up admin user..."
php artisan tinker --execute="
if (! \App\Models\User::where('email', 'admin@example.com')->exists()) {
    \$user = \App\Models\User::create([
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'email_verified_at' => now()
    ]);
    \$user->assignRole('super_admin');
}"

# Limpiar y optimizar después de toda la configuración
echo "Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

echo "Application setup completed"

# Iniciar Apache
apache2-foreground
