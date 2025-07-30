FROM php:8.3-fpm

# Installer les dépendances système et extensions PHP requises
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl mariadb-client nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP (sans dev pour la prod)
RUN composer install --optimize-autoloader --no-dev 

# Installer les dépendances front-end et builder les assets
RUN npm install && npm run build

# Générer la clé de l’application
RUN php artisan key:generate

# Donner les bons droits aux dossiers requis par Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port FPM
EXPOSE 9000

# Lancer PHP-FPM
CMD ["php-fpm"]
