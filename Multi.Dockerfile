FROM webdevops/php-nginx:8.2-alpine

RUN apk add --no-cache \
    git curl unzip bash icu-dev oniguruma-dev libzip-dev

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R application:application /app \
    && chmod -R 775 storage bootstrap/cache

# Infisical (correct way)
RUN curl -fsSL https://raw.githubusercontent.com/Infisical/infisical-cli/main/scripts/install.sh | bash

# IMPORTANT: don't break webdevops runtime
CMD ["infisical", "run", "--", "supervisord"]
CMD ["infisical", "run", "--", "php","artisan","serve", "--host=0.0.0.0", "--port=8000"]
