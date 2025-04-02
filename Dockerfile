# _____Stage 1: Build dependencies______ 
FROM php:8.1-cli-alpine AS builder

# Set working directory inside the container
WORKDIR /app

# Install system dependencies needed for Composer (Alpine uses apk)
RUN apk add --no-cache zip unzip

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

# Configure Apache for non-root operation (port 8080)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:8080/g' /etc/apache2/sites-available/*.conf

# Create a non-root user and set permissions
RUN useradd -m -s /bin/bash appuser && \
    chown -R appuser:www-data /var/www/html /var/log/apache2 /var/run/apache2

# Copy application files from the build stage
COPY --chown=appuser:www-data . .

# Copy vendor dependencies from the build stage
COPY --from=builder --chown=appuser:www-data /app/vendor ./vendor

# Remove any existing .env file (ECS will inject env vars)
RUN rm -f .env

# Expose port 8080 (mapped to host port 80 in ECS)
EXPOSE 8080

# Set user to appuser for security
USER appuser

# Start Apache when the container runs
CMD ["apache2-foreground"]