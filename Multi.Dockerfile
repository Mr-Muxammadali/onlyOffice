FROM webdevops/php-nginx:8.2-alpine

# Alpine packages
RUN apk add --no-cache \
    git curl unzip libzip-dev icu-dev oniguruma-dev \
    bash

# PHP extensions (webdevops style)
RUN docker-php-ext-install pdo pdo_mysql zip intl

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Laravel permissions (muhim)
RUN chown -R application:application /app \
    && chmod -R 775 storage bootstrap/cache

# Infisical binary
RUN curl -L https://github.com/Infisical/infisical/releases/latest/download/infisical-linux-amd64 \
    -o /usr/local/bin/infisical \
    && chmod +x /usr/local/bin/infisical

# ❗ MUHIM: webdevops entrypointni override qilamiz
CMD ["sh", "-c", "infisical run -- supervisord"]
