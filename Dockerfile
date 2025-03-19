# ====== Stage 1: Build dependencies ======
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

# ====== Stage 2: Final lightweight image ======
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

# Copy the .env file into the container and set secure permissions
COPY .env /var/www/html/.env
RUN chown appuser:www-data /var/www/html/.env && chmod 640 /var/www/html/.env

# Ensure environment variables are available to Apache/PHP
RUN echo "source /var/www/html/.env" >> /etc/apache2/envvars

# Make sure Apache log directories exist before redirection
RUN mkdir -p /var/log/apache2 /var/log/php

# Redirect Apache logs to standard log files
RUN ln -sf /dev/stdout /var/log/apache2/access.log \
    && ln -sf /dev/stderr /var/log/apache2/error.log

# Redirect PHP error logs to a dedicated file
RUN touch /var/log/php/php_errors.log \
    && chmod 666 /var/log/php/php_errors.log

# Set PHP to log errors to the new file
RUN echo "error_log = /var/log/php/php_errors.log" >> /usr/local/etc/php/conf.d/docker-php.ini

# Expose port 80
EXPOSE 80

# Ensure Apache runs with the correct permissions
USER root

# Start Apache when the container runs
CMD ["apache2-foreground"]
