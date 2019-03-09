# Web checkout con API REST

Implementación de pago web checkout con REST API de [PlacetoPay](https://dev.placetopay.com/web/redirection/).

## Instalación

Asegúrese que las siguientes extensiones están habilitadas en el archivo `php.ini` en el entorno donde desea instalar la aplicación.

Requeridos por Laravel

- OpenSSL
- PDO PHP
- Mbstring
- Tokenizer
- XML
- Ctype
- JSON
- BCMath
- Fileinfo

Requeridos para el web service

- Curl

Para instalar las dependencias ejecute desde consola el siguiente comando en la raíz de la aplicación

```bash
composer install
```

Cree la base de datos para la aplicación desde la consola sql

```bash
mysqli -u root -p
create database placetopayweb
```

Finalmente cree el database schema ejecutanto las migraciones

```bash
php artisan migrate
```

## Configuración

- Los datos de conexión de la base de datos se encuentran en el archivo `.env` al igual que los datos de autenticación del web service.

## Ejecución

Puede ejecutar la aplicación con el comando

```bash
php artisan serve
```