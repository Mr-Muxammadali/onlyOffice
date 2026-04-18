#!/bin/sh
set -e

echo "Running migrations..."
#php artisan migrate --force

echo "Clearing caches..."
php artisan optimize:clear

echo "Starting application..."
# Webdevops imeyjining asl entrypointini chaqiramiz
exec entrypoint.sh
