# Use PHP image as a base
FROM php:8.1-fpm

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    zip \
    unzip \
    git \
    curl

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application files
COPY . .

# Install PHP dependencies using Composer
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Expose port (if needed)
EXPOSE 80

# Start the PHP service (if required)
CMD ["php-fpm"]
