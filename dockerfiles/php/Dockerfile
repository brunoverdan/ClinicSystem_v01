FROM php:8.3-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    libpng-dev \
    libzip-dev \
    zlib-dev \
    mysql-client # MySQL client (se necessário para interações diretas)

# Install PHP extensions
RUN docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql # Instalando a extensão PDO para MySQL

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install node and npm
RUN apk add --no-cache nodejs npm

# Set working directory
WORKDIR /var/www

EXPOSE 9000