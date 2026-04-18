#!/bin/sh
set -e

echo "Running migrations..."
php artisan migrate --force

echo "Clearing caches..."
php artisan optimize:clear

echo "Starting application..."
# Webdevops imeyjining asl entrypoint fayli ildiz papkada joylashgan
# Shuning uchun oldiga "/" qo'yish shart
exec /entrypoint.sh
