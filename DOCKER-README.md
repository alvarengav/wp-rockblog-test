
# Plantilla Docker para Desarrollo en WordPress

Este proyecto sirve como una plantilla para levantar un entorno de desarrollo local para WordPress, ideal para la creación y el testeo de temas y plugins personalizados. La carpeta `wp-core` es utilizada como un volumen en el `docker-compose.yml` y contiene todo el núcleo de WordPress. La inclusión de este volumen es crucial para aprovechar las funcionalidades de autocompletado y detección de errores en tiempo real que proporcionan editores de texto avanzados como Visual Studio Code con Intellisense, mejorando significativamente la experiencia de desarrollo.

## Pre-requisitos

Antes de comenzar, asegúrate de tener lo siguiente instalado y configurado:

- **Windows Subsystem for Linux (WSL)**: Este proyecto ha sido probado con una imagen de Ubuntu 22.04 en WSL. Necesitarás WSL instalado y ejecutándose en tu máquina Windows para proceder.

## Configuración Inicial

1. **Xdebug**: Esta herramienta es opcional y es útil para el debugging. Xdebug puede afectar el rendimiento, por lo que si prefieres no utilizarlo, asegúrate de eliminar o comentar la línea `WITH_XDEBUG` en el archivo `docker-compose.yml`, o establecerla en `false`.

2. **Identificadores de Usuario y Nombre del Usuario**: Es crucial configurar correctamente el nombre de usuario y los identificadores para evitar problemas de permisos con los archivos creados por los contenedores Docker, especialmente en la carpeta `wp-core`. Esta carpeta se sincroniza con el contenedor de WordPress y te permite trabajar directamente con los archivos del núcleo de WordPress, lo que facilita el desarrollo y la depuración de temas y plugins. En el archivo `docker-compose.yml`, el `USER_NAME` ya está configurado para utilizar la variable de entorno `$USER` de tu sistema WSL. Por defecto, los valores de `USER_ID` y `GROUP_ID` están establecidos en `1000`, que son los valores típicos en un sistema Linux/WSL. Si estos valores son diferentes en tu sistema, es importante que los actualices en el `docker-compose.yml` para que coincidan con tu entorno de WSL. Puedes verificar y actualizar tus valores actuales ejecutando los siguientes comandos en WSL:

    ```sh
    echo $USER  # Devuelve tu nombre de usuario de WSL
    id -u       # Devuelve tu User ID
    id -g       # Devuelve tu Group ID
    ```

### Volumen de la Base de Datos

El volumen `db_data` se utiliza para hacer que la base de datos MySQL sea persistente, lo que significa que tus datos no se perderán cuando el contenedor de la base de datos se detenga o se elimine. Si deseas hacer que este volumen sea persistente más allá del ciclo de vida de los contenedores, puedes crear el volumen manualmente y luego modificar el archivo `docker-compose.yml` para incluir `db_data` como un volumen externo:

```yaml
volumes:
  db_data:
    external: true
```

Crea el volumen con:

```sh
docker volume create db_data
```

## Instrucciones de Uso

Una vez que hayas realizado las configuraciones necesarias, sigue estos pasos para iniciar tu entorno de desarrollo de WordPress:

1. Abre una terminal en tu sistema WSL.

2. Navega al directorio donde se encuentra tu proyecto de WordPress.

3. Ejecuta uno de los siguientes comandos en la terminal, dependiendo de tu caso:

   - Si es la primera vez que levantas el proyecto, o si has realizado cambios en el `Dockerfile` o en los `args` del servicio `wordpress`, utiliza:

     ```sh
     docker-compose up --build
     ```

   - Si prefieres ejecutar los contenedores en modo "detached" (en segundo plano) y no necesitas reconstruir las imágenes, puedes ejecutar:

     ```sh
     docker-compose up -d
     ```

Accede a WordPress en `http://localhost:8080` y a phpMyAdmin en `http://localhost:8081`. Los cambios en `wp-core` se sincronizan con el entorno local y los datos de MySQL se mantienen en `db_data`.

## Herramientas de Depuración (Opcional)

Para mejorar la calidad del código y adherirse a las buenas prácticas, puedes configurar las siguientes herramientas de depuración en tu entorno de desarrollo:

- **PHP Code Sniffer**: Una herramienta que ayuda a detectar violaciones de un estándar de codificación definido. Puedes instalarla y encontrar más información en su [repositorio de GitHub](https://github.com/PHPCSStandards/PHP_CodeSniffer/).

- **WordPress Coding Standards**: Un conjunto de reglas de PHP Code Sniffer que te ayudan a adherirte a los estándares de codificación de WordPress. Encuentra más detalles y guías de uso en su [repositorio de GitHub](https://github.com/WordPress/WordPress-Coding-Standards).