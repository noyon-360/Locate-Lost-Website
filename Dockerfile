# Use official PHP image with Apache
FROM php:8.2-apache

# Install required system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libssl-dev \
    pkg-config \
    && docker-php-ext-install pdo_mysql gd

# # Install MongoDB extension
# RUN pecl install mongodb \
#     && echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside the container
WORKDIR /var/www/html

# Copy Laravel project files
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install dependencies
RUN composer install --ignore-platform-req=ext-mongodb --no-dev --optimize-autoloader

# Expose port 80 for Apache
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
