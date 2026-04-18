# 1-bosqich: Vendor-builder
# PHP-ni aynan o'zingiz ishlatayotgan versiyada (8.3) oling
FROM php:8.3-alpine AS vendor-builder

# Composer ni yuklash
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Kerakli PHP extension va kutubxonalarni o'rnatish
RUN apk add --no-cache postgresql-dev libpq git unzip \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app
COPY composer.* ./

# --ignore-platform-reqs qo'shdik, chunki builder ichida barcha ext-lar bo'lmasligi mumkin
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction --ignore-platform-reqs

# 2-bosqich: Yakuniy Image (Runtime)
FROM webdevops/php-nginx:8.3-alpine

# Runtime uchun kerakli kutubxonalar
RUN apk add --no-cache postgresql-dev libpq \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app

# Faqat tayyor vendor'ni ko'chiramiz
COPY --from=vendor-builder /app/vendor /app/vendor

RUN chmod +x entrypoint.sh

COPY . .

# Ruxsatlarni to'g'rilash
RUN chown -R application:application /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

ENV WEB_DOCUMENT_ROOT=/app/public


EXPOSE 80
