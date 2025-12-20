# Use official PHP with Apache
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies and build assets (if using Vite/Mix)
COPY package*.json ./
RUN if [ -f "package.json" ]; then npm ci --only=production && npm run build; fi

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/bootstrap/cache

# Copy Apache configuration
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Expose port
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]