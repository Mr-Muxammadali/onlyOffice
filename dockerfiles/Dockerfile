FROM php:8.3.21-fpm-alpine3.20

WORKDIR /var/www/laravel

RUN apk add --no-cache \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    libxpm-dev \
    freetype-dev \
    zip \
    unzip \
    openssl-dev \
    autoconf \
    make \
    gcc \
    g++ \
    linux-headers \
    postgresql-dev \
    && docker-php-ext-install pcntl \
    && pecl install swoole \
    && docker-php-ext-enable swoole \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql pdo_pgsql bcmath \
    && apk del autoconf make gcc g++ linux-headers

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN chown -R www-data:www-data /var/www/laravel \
    && chmod -R 775 /var/www/laravel

USER www-data
