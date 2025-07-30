#!/usr/bin/env bash

composer install --no-dev --optimize-autoloader

cp .env.example .env

php artisan key:generate

php artisan config:cache
php artisan route:cache
