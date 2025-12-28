#!/bin/bash
set -e

# Disable conflicting MPMs
a2dismod mpm_event || true
a2dismod mpm_worker || true
a2enmod mpm_prefork

# Suppress ServerName warning
echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Configure Port dynamically (Railway sets $PORT)
p="${PORT:-80}"
echo "----------------------------------------"
echo "Railway Port Detected: $p"
echo "Binding Apache to 0.0.0.0:$p"
echo "----------------------------------------"

# Update ports.conf to listen on 0.0.0.0:PORT (Force IPv4)
sed -i "s/Listen 80/Listen 0.0.0.0:$p/g" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$p>/g" /etc/apache2/sites-available/000-default.conf

# Hand off to the original command
exec docker-php-entrypoint "$@"
