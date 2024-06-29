FROM wordpress:latest

# Argumentos para el nombre de usuario y IDs (opcional)
ARG USER_NAME
ARG USER_ID
ARG GROUP_ID

# Argumento para controlar la instalación de Xdebug
ARG WITH_XDEBUG=false

# Configurar las variables de entorno con los valores de los argumentos
ENV USER_NAME=${USER_NAME}
ENV USER_ID=${USER_ID}
ENV GROUP_ID=${GROUP_ID}

# Instrucciones condicionales para crear el grupo y el usuario solo si se proporcionan los argumentos
RUN if [ ! -z "$USER_NAME" ] && [ ! -z "$USER_ID" ] && [ ! -z "$GROUP_ID" ]; then \
    if groupadd -g ${GROUP_ID} ${USER_NAME} && useradd -u ${USER_ID} -g ${GROUP_ID} -m ${USER_NAME}; then \
    echo "Usuario y grupo ${USER_NAME} creados y asignados con éxito."; \
    else \
    echo "Error: No se pudo crear el usuario y/o grupo ${USER_NAME}." >&2; \
    exit 1; \
    fi; \
    fi

# Establecer la variable de entorno para el usuario y grupo de Apache, condicionalmente
ENV APACHE_RUN_USER=${USER_NAME:-www-data}
ENV APACHE_RUN_GROUP=${USER_NAME:-www-data}

# Instalación condicional de Xdebug
RUN if [ "$WITH_XDEBUG" = "true" ]; then \
    if ! (pecl install xdebug && docker-php-ext-enable xdebug); then \
    echo "Error: No se pudo instalar Xdebug." >&2; \
    exit 1; \
    else \
    echo "Xdebug instalado con éxito."; \
    fi; \
    fi

# Copiar el script de inicio
COPY start.sh /start.sh

# Hacer el script ejecutable
RUN chmod +x /start.sh

CMD ["/start.sh"]
