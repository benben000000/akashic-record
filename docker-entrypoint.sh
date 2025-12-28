#!/bin/bash
set -e

# Disable conflicting MPMs
a2dismod mpm_event || true
a2dismod mpm_worker || true
a2enmod mpm_prefork

# Suppress ServerName warning
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Port dynamically (Railway sets $PORT)
# Default to 80 if not set
p="${PORT:-80}"
sed -i "s/80/$p/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Hand off to the original command
exec docker-php-entrypoint "$@"
