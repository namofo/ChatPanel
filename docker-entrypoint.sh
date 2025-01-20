#!/bin/bash

# Configurar permisos de storage y cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Esperar a que MySQL esté disponible
until php artisan db:show >/dev/null 2>&1; do
  echo "Waiting for database to be ready..."
  sleep 2
done

# Limpiar y optimizar
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Ejecutar migraciones en orden
echo "Running migrations..."
php artisan migrate:fresh --force --seed

# Crear enlaces simbólicos de storage
php artisan storage:link

# Instalar Filament Shield
echo "Installing Filament Shield..."
php artisan shield:install --fresh

# Crear superadmin si no existe
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

# Optimizar después de todas las configuraciones
php artisan optimize

# Iniciar Apache
apache2-foreground
