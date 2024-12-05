composer install
npm install --production
chmod -R 775 storage
mkdir -p public/storage
chmod -R 775 public/storage
php artisan storage:link
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force