# =======================
# 1. Node stage (frontend build)
# =======================
FROM node:20-alpine AS node

WORKDIR /app

# package fayllarni copy qilamiz
COPY package*.json ./

RUN npm install

# qolgan kodni copy
COPY . .

# build (Vite / Mix)
RUN npm run build


# =======================
# 2. PHP stage (backend)
# =======================
FROM php:8.3-fpm-alpine

WORKDIR /var/www/laravel

# Kerakli paketlar
RUN apk add --no-cache \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    unzip \
    postgresql-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql bcmath gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Laravel kodini copy qilamiz
COPY . .

# Node build natijasini olib kelamiz
COPY --from=node /app/public/build ./public/build

# Laravel optimizatsiya
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache

# permission
RUN chown -R www-data:www-data /var/www/laravel

USER www-data

EXPOSE 9000

CMD ["php-fpm"]
