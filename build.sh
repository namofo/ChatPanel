#!/bin/bash
set -e

echo "Instalando dependencias de Composer..."
composer install --no-dev --optimize-autoloader

echo "Instalando dependencias de Node.js..."
npm ci --production

echo "Configurando caché de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Ejecutando migraciones..."
php artisan migrate --force

echo "Instalando y configurando Filament Shield..."
echo "yes" | php artisan shield:install --fresh <<EOF
Alberto
soy@beto.com
15df45df12fg1M
EOF

echo "Proceso de construcción completado con éxito."
