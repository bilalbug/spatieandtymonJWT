# Use the official PHP image as the base image
FROM php:8.2-apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    curl

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy the source code to the container
COPY . .

# Set the appropriate permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 storage

# Install Laravel dependencies
RUN composer install --optimize-autoloader --no-dev

# Generate Laravel application key
RUN php artisan key:generate

# Install Tymon JWT Auth package
RUN composer require tymon/jwt-auth

# Install Spatie packages
RUN composer require spatie/laravel-permission spatie/laravel-medialibrary

# Set up Apache rewrite rules
RUN a2enmod rewrite

# Copy Apache virtual host file
COPY apache2.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache site configuration
RUN a2ensite 000-default

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
