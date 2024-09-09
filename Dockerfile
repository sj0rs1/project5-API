FROM php:8.1

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    build-essential \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

RUN composer install --no-dev --no-interaction --optimize-autoloader

EXPOSE 8080

CMD php artisan serve --host=0.0.0.0 --port=8080




#FROM php:8.1

#RUN apt-get update && apt-get install -y \
#    libpq-dev \
#    && docker-php-ext-install pdo pdo_pgsql

#WORKDIR /var/www/html

#COPY . .

#RUN chown -R www-data:www-data \
#    /var/www/html/storage \
#    /var/www/html/bootstrap/cache

#CMD php artisan serve --host=0.0.0.0 --port=8080

