FROM php:8.3-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl mariadb-client nodejs npm libpq-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy custom Apache virtual host config
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install PHP dependencies (excluding dev dependencies)
RUN composer install --optimize-autoloader --no-dev

# Install frontend dependencies and build assets (Vite)
RUN npm install && npm run build

# Set proper permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chown -R www-data:www-data /var/www

# Copy and make the entrypoint script executable
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Expose Apache HTTP port
EXPOSE 80

# Run the entrypoint script
CMD ["/entrypoint.sh"]
