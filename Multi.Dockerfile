FROM php:8.2-cli

# System deps + postgres
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        curl \
        git \
        unzip \
        libpq-dev \
        postgresql-client \
        ca-certificates \
        gnupg \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*

# Infisical CLI
RUN curl -fsSL https://artifacts-cli.infisical.com/setup.deb.sh | bash \
    && apt-get update \
    && apt-get install -y infisical \
    && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .
#test hook fire o

RUN composer install --no-dev --optimize-autoloader

#CMD ["infisical", "run", "--", "php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
CMD [ "php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
