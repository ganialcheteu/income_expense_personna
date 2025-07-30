#!/bin/bash

# Générer le fichier .env si manquant
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Générer la clé d'application (force pour éviter les confirmations)
php artisan key:generate --force

# Lancer PHP-FPM
exec php-fpm
