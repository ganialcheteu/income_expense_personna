FROM php:8.3-apache

# Installer les dépendances système et extensions PHP requises
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl mariadb-client nodejs npm \
    && docker-php-ext-install pdo pdo_mysql zip

# Activer mod_rewrite (important pour Laravel)
RUN a2enmod rewrite

# Configurer Apache pour servir le dossier public de Laravel
RUN echo "<VirtualHost *:80>
    DocumentRoot /var/www/public
    <Directory /var/www/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP (sans les dépendances de dev)
RUN composer install --optimize-autoloader --no-dev

# Installer les dépendances front-end et builder les assets Vite
RUN npm install && npm run build

# Donner les bons droits aux dossiers requis par Laravel
RUN chown -R www-data:www-data storage bootstrap/cache

# Donner les bons droits à tout le dossier Laravel
RUN chown -R www-data:www-data /var/www

# Copier le script d’entrée
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

# Exposer le port HTTP (80) utilisé par Apache
EXPOSE 80

# Lancer le script d’entrée au démarrage du conteneur
CMD ["/entrypoint.sh"]
