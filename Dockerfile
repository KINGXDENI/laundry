FROM php:8.1-fpm

# Install required packages
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www

# Copy the application files
COPY . .

# Install PHP dependencies
RUN composer install
