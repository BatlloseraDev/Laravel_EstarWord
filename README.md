# Laravel EstarWord

Una API RESTful de temática Star Wars construida con Laravel. Este proyecto sirve como demostración práctica de las características clave del framework para crear una aplicación backend robusta y escalable.

## Descripción del Proyecto

El objetivo principal de `Laravel_EstarWord` es implementar un backend que gestione entidades del universo Star Wars (como Pilotos, Naves y Planetas). El proyecto pone un fuerte énfasis en el uso correcto de **Eloquent ORM**, la **gestión de permisos** y la **integración con servicios de terceros** como Cloudinary.

-----

## Características Principales

Este proyecto implementa varias de las funcionalidades más importantes de Laravel:

  * **ORM y Base de Datos:**

      * **Eloquent:** Uso intensivo del ORM para la interacción con la base de datos y la definición de relaciones (ej. `belongsTo`, `belongsToMany`).
      * **Migraciones:** Gestión de la estructura de la base de datos.
      * **Seeders y Factories:** Población de la base de datos con datos de prueba realistas para un desarrollo eficiente.

  * **Autenticación y Autorización:**

      * **Sanctum:** Para la autenticación basada en tokens.
      * **Gates y Policies (Abilities):** Definición de reglas de negocio y permisos para controlar qué acciones puede realizar un usuario.
      * **Middleware:** Protección de rutas y recursos basada en los permisos y roles del usuario.

  * **API y Validación:**

      * **Request Validators:** Uso de Form Requests para validar, limpiar y autorizar los datos entrantes antes de que lleguen a los controladores.
      * **Rutas de API:** Definición clara de endpoints en `routes/api.php`.

  * **Gestión de Archivos:**

      * **Cloudinary:** Integración con un servicio externo para la subida, almacenamiento y gestión de imágenes (perfiles de pilotos).

  * **Testing:**

      * **PHPUnit:** Creación de pruebas unitarias y de integración (Feature tests) para asegurar la fiabilidad de los endpoints, la lógica de negocio y las integraciones.

-----

## Instalación y Puesta en Marcha

Sigue estos pasos para poner en funcionamiento el proyecto en tu entorno local.

1.  **Clonar el repositorio:**

    ```bash
    git clone https://github.com/BatlloseraDev/Laravel_EstarWord.git
    cd Laravel_EstarWord
    ```

2.  **Instalar dependencias:**

    ```bash
    composer install
    ```

3.  **Configurar el entorno:**

      * Copia el archivo de ejemplo `.env.example` a `.env`:
        ```bash
        cp .env.example .env
        ```
      * Configura tus variables de entorno en el archivo `.env`, especialmente:
          * Conexión a la base de datos (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
          * Credenciales del servicio de Cloudinary (`CLOUDINARY_URL` o similar).

4.  **Generar la clave de la aplicación:**

    ```bash
    php artisan key:generate
    ```

5.  **Ejecutar las migraciones y seeders:**

      * Esto creará la estructura de la base de datos y la llenará con datos de prueba.

    <!-- end list -->

    ```bash
    php artisan migrate --seed
    ```

6.  **Iniciar el servidor:**

    ```bash
    php artisan serve
    ```

-----

## Pruebas (Testing)

El proyecto incluye un conjunto de pruebas para verificar el correcto funcionamiento de los endpoints y la lógica de negocio.

Para ejecutar todas las pruebas, utiliza el siguiente comando:

```bash
php artisan test
```


-----

Si se quiere practicar sobre este proyecto o se quiere hacer una contribución sois libres de hacer un fork 
