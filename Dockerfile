FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions (QUAN TRỌNG - PDO MySQL)
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Verify pdo_mysql is installed
RUN php -m | grep pdo_mysql

# Get Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files first (for caching)
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-interaction --prefer-dist --no-dev --no-scripts

# Copy the rest of the application
COPY . .

# Run composer scripts
RUN composer dump-autoload --optimize

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8080

# Start command
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
