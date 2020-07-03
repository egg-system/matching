#!/bin/sh
set -e

php artisan migrate --seed
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan optimize

php-fpm
