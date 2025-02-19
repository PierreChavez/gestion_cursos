# Use the official PHP image as the base image
FROM php:8.2-cli

# Set working directory
WORKDIR /app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_pgsql mbstring exif pcntl bcmath gd

# Install Composer and Node.js
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && apt-get install -y nodejs

# Install Xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug

# Copy existing application directory contents
COPY . .

# Install Composer dependencies
RUN composer install

# Install npm dependencies
RUN npm install

# Ensure the storage and cache directories exist and have the correct permissions
RUN mkdir -p storage/framework/cache/data \
    && mkdir -p storage/logs \
    && mkdir -p bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache

# Expose ports
EXPOSE 8000

# Command to run the application
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
