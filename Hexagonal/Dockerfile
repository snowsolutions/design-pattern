# Base Image
FROM php:8.3-fpm AS base

# Install required packages
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    git \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli && \
    docker-php-ext-enable pdo_mysql mysqli

# Install Composer globally
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Set up application files
COPY ./ /var/www/html
COPY .docker/nginx.conf /etc/nginx/nginx.conf

# Create a non-root user
RUN useradd -m -s /bin/bash app

# Set permissions
RUN chown -R www-data:www-data /var/www/html/Ports/Laravel/storage /var/www/html/Ports/Laravel/bootstrap
RUN chown -R app:app /var/www/html

# Expose port
EXPOSE 80

# Web Build Stage
FROM base AS web

# Switch to the app user
USER app

# Install Laravel dependencies
WORKDIR /var/www/html/Ports/Laravel
RUN composer install --no-dev --optimize-autoloader -vvv

# Install Symfony dependencies
WORKDIR /var/www/html/Ports/Symfony
RUN composer install --no-dev --optimize-autoloader -vvv

# Copy Supervisor configuration
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

USER root
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]

# Feature Flag Build Stage
FROM base AS feature_flag

# Switch to the app user
USER app

COPY ./FeatureFlag /var/www/html

# Install dependencies for the entire application
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader -vvv

# Copy Supervisor configuration
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Default command
USER root
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]