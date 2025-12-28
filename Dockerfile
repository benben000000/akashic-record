FROM php:8.2-apache

# Force remove any conflicting MPMs (the source of the crash)
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
    && a2enmod mpm_prefork \
    && a2enmod rewrite

# Copy application source
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
