#!/bin/bash

set -e

echo "Instalando dependencias PHP..."
composer install --no-dev --optimize-autoloader

echo "Instalando dependencias Node.js..."
npm ci --production

echo "Configurando caché..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Instalando Filament Shield..."
php artisan shield:setup

echo "Build completado con éxito."
