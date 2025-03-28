# _____Stage 1: Build dependencies______ 
FROM php:8.1-cli AS builder

# Set working directory inside the container
WORKDIR /app

# Install system dependencies needed for Composer
RUN apt-get update && apt-get install -y --no-install-recommends zip unzip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy only necessary files for dependencies
COPY composer.json composer.lock ./

# Ensure dependencies are up to date and optimize installation
RUN composer update && COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --optimize-autoloader

# _____ Stage 2: Final lightweight image _____
FROM php:8.1-apache-bookworm AS runtime

# Set a secure working directory
WORKDIR /var/www/html

# Install required PHP extensions and clean up apt cache
RUN apt-get update && apt-get install -y --no-install-recommends \
    libpq-dev libzip-dev unzip \
    && docker-php-ext-install mysqli pdo pdo_mysql zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Create a non-root user for security
RUN useradd -m -s /bin/bash appuser && chown -R appuser:www-data /var/www/html

# Copy application files from the build stage
COPY --chown=appuser:www-data . .

# Copy vendor dependencies from the build stage
COPY --from=builder --chown=appuser:www-data /app/vendor ./vendor

# Remove any existing .env file (we are using ECS environment variables)
RUN rm -f /var/www/html/.env

# Expose port 80
EXPOSE 80

# Set user to appuser for security
USER appuser

# Start Apache when the container runs
CMD ["apache2-foreground"]
