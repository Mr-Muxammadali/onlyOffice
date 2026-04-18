# 1-bosqich: Vendor-builder
FROM php:8.3-alpine AS vendor-builder

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN apk add --no-cache postgresql-dev libpq git unzip \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app
COPY composer.* ./

RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction --ignore-platform-reqs

# 2-bosqich: Yakuniy Image (Runtime)
FROM webdevops/php-nginx:8.3-alpine

RUN apk add --no-cache postgresql-dev libpq \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app

COPY --from=vendor-builder /app/vendor /app/vendor

# 1. Kodni ko'chiramiz
COPY . .

# 2. Entrypointni to'g'ri joyga o'tkazib, ruxsat beramiz
RUN chmod +x ./entrypoint.sh

# 3. Ruxsatlarni to'g'rilash
RUN chown -R application:application /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

ENV WEB_DOCUMENT_ROOT=/app/public

EXPOSE 80
