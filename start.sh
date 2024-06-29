#!/bin/bash

# Verificar si USER_NAME, USER_ID y GROUP_ID están establecidos
if [ ! -z "$USER_NAME" ] && [ ! -z "$USER_ID" ] && [ ! -z "$GROUP_ID" ]; then
    # Cambiar permisos
    chown -R $USER_NAME:$USER_NAME /var/www/html
    echo "Permissions set for /var/www/html"
else
    echo "No permission change for /var/www/html"
fi

# Iniciar Apache en primer plano
exec docker-entrypoint.sh apache2-foreground
