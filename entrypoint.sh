#!/bin/bash

# Générer .env s'il est manquant
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Générer la clé Laravel uniquement si APP_KEY est vide
if [ -z "$(grep '^APP_KEY=' .env | cut -d '=' -f2)" ]; then
    php artisan key:generate --force
fi

# Démarrer Apache (pour images php:apache)
exec apache2-foreground
