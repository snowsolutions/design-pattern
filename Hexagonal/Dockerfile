# Dockerfile
FROM php:8.3-fpm AS base

# Install Nginx and Supervisor
RUN apt-get update && apt-get install -y \
    nginx \
    supervisor \
    && rm -rf /var/lib/apt/lists/*


RUN docker-php-ext-install pdo_mysql mysqli && \
    docker-php-ext-enable pdo_mysql mysqli

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY ./ /var/www/html
# Copy Nginx configuration
COPY .docker/nginx.conf /etc/nginx/nginx.conf
# Create a non-root user
RUN useradd -m -s /bin/bash app
EXPOSE 80

FROM base AS web
RUN chown -R www-data:www-data /var/www/html/Ports/Laravel/storage
RUN chown -R www-data:www-data /var/www/html/Ports/Laravel/bootstrap
USER app
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html/Ports/Laravel
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html/Ports/Symfony

COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["supervisord", "-n"]

FROM base AS feature_flag
RUN composer install --no-dev --optimize-autoloader --working-dir=/var/www/html/
COPY .docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
CMD ["supervisord", "-n"]