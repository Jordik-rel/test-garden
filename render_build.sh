#!/usr/bin/env bash

echo "🚀 Démarrage du déploiement Laravel sur Render..."

# Installer les dépendances
composer install --no-dev --optimize-autoloader

# Générer la clé (Render fournira APP_KEY via env var)
# php artisan key:generate --force

# Optimisations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Assets frontend (si vous utilisez Vite/Mix)
if [ -f "vite.config.js" ]; then
    npm ci --only=production
    npm run build
elif [ -f "webpack.mix.js" ]; then
    npm ci --only=production
    npm run production
fi

echo "✅ Build terminé!"