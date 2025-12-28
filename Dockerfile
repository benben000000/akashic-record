FROM php:8.2-apache

# Copy and set up entrypoint
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]

# Copy application source
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
