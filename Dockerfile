FROM webdevops/php-nginx:8.2-alpine

WORKDIR /app

# system deps
RUN apk add --no-cache \
    postgresql-dev \
    git \
    unzip

# PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql

# Infisical CLI
RUN curl -fsSL https://artifacts-cli.infisical.com/setup.deb.sh | bash \
    && apt-get update \
    && apt-get install -y infisical \
    && rm -rf /var/lib/apt/lists/*

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

ENV WEB_DOCUMENT_ROOT=/app/public

EXPOSE 80
