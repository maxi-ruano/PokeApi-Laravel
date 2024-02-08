# Use an official PHP runtime as a parent image
FROM php:7.4-fpm

# Set the working directory to /app
WORKDIR /app

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo_mysql

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the current directory contents into the container at /app
COPY . /app

# Install project dependencies
RUN composer install --no-scripts

# Make port 8000 available to the world outside this container
EXPOSE 8000

# Run the application
CMD php artisan serve --host=0.0.0.0 --port=8000
