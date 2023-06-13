# Use a PHP base image
FROM php:7.4-apache

# Install PostgreSQL extension
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Copy your PHP files to the container
COPY . /var/www/html/

# Set up Apache
RUN a2enmod rewrite

# Expose port 80 for Apache
EXPOSE 80
