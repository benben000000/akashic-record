FROM php:8.2-apache

# Enable mod_rewrite for extensive routing (if needed later)
RUN a2enmod rewrite

# Copy application source
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
