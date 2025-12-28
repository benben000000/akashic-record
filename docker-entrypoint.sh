#!/bin/bash
set -e

# Disable conflicting MPMs
a2dismod mpm_event || true
a2dismod mpm_worker || true
a2enmod mpm_prefork

# Hand off to the original command
exec docker-php-entrypoint "$@"
