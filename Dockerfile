# 1-bosqich: Composer orqali vendor'larni tayyorlab olish
FROM composer:2 AS vendor-builder
WORKDIR /app
COPY composer.* ./
# --no-dev faqat production uchun kerakli bo'lganlarini yuklaydi
RUN composer install --no-dev --optimize-autoloader --no-scripts --no-interaction

# 2-bosqich: Yakuniy Image (Runtime)
FROM webdevops/php-nginx:8.3-alpine

# Kerakli PHP kengaytmalarini o'rnatish
RUN apk add --no-cache postgresql-dev libpq \
    && docker-php-ext-install pdo pdo_pgsql

WORKDIR /app

# Faqat tayyor vendor'ni ko'chiramiz
COPY --from=vendor-builder /app/vendor /app/vendor
COPY . .

# Ruxsatlarni to'g'rilash (Xavfsizlik uchun)
RUN chown -R application:application /app \
    && chmod -R 775 /app/storage /app/bootstrap/cache

ENV WEB_DOCUMENT_ROOT=/app/public

# Infisical CLI container ichida yo'q, u hostdan volume orqali ulanadi.
# Shu sababli, biz entrypointni shunchaki infisical buyrug'i bilan boshlaymiz.
ENTRYPOINT ["infisical", "run", "--", "/entrypoint.sh"]

EXPOSE 80
