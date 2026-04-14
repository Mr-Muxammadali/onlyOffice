FROM webdevops/php-nginx:8.2-alpine

# System deps
RUN apt-get update && apt-get install -y \
    git curl unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

# ❗ Infisical binary (eng stabil)
RUN curl -L https://github.com/Infisical/infisical/releases/latest/download/infisical-linux-amd64 \
    -o /usr/local/bin/infisical \
    && chmod +x /usr/local/bin/infisical

CMD ["sh", "-c", "infisical run -- php-fpm"]
