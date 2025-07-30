#!/bin/bash

# Generate .env if missing
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate Laravel app key
php artisan key:generate --force

# Start Apache (required for php:apache images)
exec apache2-foreground
