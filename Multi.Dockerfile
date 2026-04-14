FROM php:8.2-cli

# System deps
RUN apt-get update && apt-get install -y \
    curl git unzip \
    && rm -rf /var/lib/apt/lists/*

# Infisical CLI (rasmiy docs bo‘yicha)
RUN curl -1sLf 'https://artifacts-cli.infisical.com/setup.deb.sh' | bash \
    && apt-get update \
    && apt-get install -y infisical

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD ["infisical", "run", "--", "php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
