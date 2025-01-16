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

COPY .docker/nginx.conf /etc/nginx/nginx.conf

# Create a non-root user
RUN useradd -m -s /bin/bash app

# Expose port
EXPOSE 80

# Web Build Stage
FROM base AS web
# Set up application files

COPY ./ /var/www/html

# Set permissions
RUN chown -R www-data:www-data /var/www/html/Adapters/Laravel/storage /var/www/html/Adapters/Laravel/bootstrap
RUN chown -R app:app /var/www/html

# Switch to the app user
USER app

# Install Laravel dependencies
WORKDIR /var/www/html/Adapters/Laravel
#RUN composer install --no-dev --optimize-autoloader -vvv
RUN php artisan migrate

# Install Symfony dependencies
WORKDIR /var/www/html/Adapters/Symfony
#RUN composer install --no-dev --optimize-autoloader -vvv

# Copy Supervisor configuration
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

USER root
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]

# Feature Flag Build Stage
FROM base AS feature_flag

COPY ./Shared/FeatureFlag /var/www/html

RUN ls -lah /var/www/html

RUN chown -R app:app /var/www/html
# Switch to the app user
USER app
# Install dependencies for the entire application
WORKDIR /var/www/html

#RUN composer install --no-dev --optimize-autoloader -vvv

# Copy Supervisor configuration
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Default command
USER root
CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]