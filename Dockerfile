FROM php:8.2-cli

# 1. Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client \
    ca-certificates

# 2. Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 3. Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 4. Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 5. Set working directory
WORKDIR /app

# 6. Copy composer files first (Caching)
COPY composer.json composer.lock ./

# 7. Install dependencies
RUN composer install --no-interaction --prefer-dist --no-dev --no-scripts

# 8. Copy application code
COPY . .

# 9. Optimize Autoloader
RUN composer dump-autoload --optimize

# 10. Fix Permissions (QUAN TRỌNG CHO RENDER)
# Render chạy user ID 1000, ta cần đảm bảo folder storage ghi được
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

# 11. Expose Port
EXPOSE 8080

# 12. Start Command
# Tôi bỏ lệnh migrate đi để tránh lỗi vì ông đã import DB bằng tay rồi.
# Nếu cần migrate thì chạy sau trong Shell.
CMD php artisan serve --host=0.0.0.0 --port=$PORT
