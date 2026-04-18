FROM webdevops/php-nginx:8.3-alpine

WORKDIR /app

RUN apk add --no-cache \
    postgresql-dev \
    git \
    unzip \
    bash \
    curl

RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R application:application /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache
    
ENV WEB_DOCUMENT_ROOT=/app/public

EXPOSE 80
