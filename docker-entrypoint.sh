#!/bin/bash

# Esperar a que MySQL esté disponible
until php artisan db:show >/dev/null 2>&1; do
  echo "Waiting for database to be ready..."
  sleep 2
done

# Ejecutar migraciones
php artisan migrate --force

# Instalar Filament Shield
php artisan shield:install --fresh

# Crear superadmin si no existe
php artisan tinker --execute="
if (! \App\Models\User::where('email', 'admin@example.com')->exists()) {
    \App\Models\User::create([
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('password123'),
        'email_verified_at' => now()
    ]);
    \Filament\Models\Contracts\HasName::class;
    \BezhanSalleh\FilamentShield\Support\Utils::getSuperAdminRoleName();
    \App\Models\User::first()->assignRole('super_admin');
}"

# Iniciar Apache
apache2-foreground
