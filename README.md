# EVIUS API (Events)
Este proyecto se encuentra el API de EVIUS plataforma de eventos.

EVIUS se compone de los siguientes proyectos
no es necesario instalarlos todos según el desarrollo que se quiera realizar.

- EVIUS API  https://bitbucket.org/modev/eviusapilaravel/src
- EVIUSAUTH https://bitbucket.org/modev/eviusauth 
- administradorevius (para administrar los eventos) https://bitbucket.org/modev/administradorevius
- eviusfirebasemanagement   (para actualizar los usuarios en firebase) https://bitbucket.org/modev/eviusfirebasemanagement 
- frontvius (el portal que ven los usuarios no administradores https://bitbucket.org/modev/frontvius

### Documentation
API Documentation can be found inside this repository  in public/docs it can be loaded in a brower is pure HTML

for developers:
documentation can be generated using

```
php artisan api:generate --routePrefix="api/*" 
``` 

How this documentation is generated can be found in https://github.com/mpociot/laravel-apidoc-generator


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

- PHP 7.3 (works on Laravel) 
- MongoDB (compass gui visual client)
- Composer
- Evius auth server (https://bitbucket.org/modev/eviusauth/)
- el login se maneja con el este servicio de autenticación, tiene que estar corriendo para poder loguearse.


### Installing

1. Then install MongoDB PHP Driver
https://github.com/mongodb/mongo-php-driver

installing MongoDB PHP Driver is somewhat involved:  

using pecl:

* sudo apt-get install php[myversion]-dev
* sudo apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev #this line is required if you  have authentication enabled in mongodb
* sudo pecl install mongodb

```
please be careful that mongodb version should be superior than:
version ^1.5.0
```

* Verifique que las Api coincidad con: phpize -v

```
En caso de que no coincidan ejecute:
* sudo update-alternatives --set phpize /usr/bin/phpize[myversion]
* sudo update-alternatives --set php-config /usr/bin/php-config[myversion]
y verifique nuevamente
```

also avoid installing mongodb php driver using apt-get usually It installs the wrong version

* You should add "extension=mongodb.so" to php.ini for web and cli versions
* restart webServer

2. composer install inside proyect folder
3. npm i inside proyect folder
4. copy the .env.example 

```
cp .env.example .env
```
5. generate encryption key

```
php artisan key:generate
```
and store the key in .env file with APP_KEY name

```
APP_KEY = ZqxYyhRadx1UNwPgdjXsmeG/MvBZO6ZR6PeUuCa6cAs=
```

6. copy the code of the database in the .env

```
DB_CONNECTION=mongodb
DB_HOST="cluster0-gp9gs.mongodb.net"
DB_PORT=27017
DB_DATABASE=evius
DB_USERNAME=root
DB_PASSWORD=amazonas.2040
```

7. Make sure storage folder has right permissions for laravel to store stuff there.

### Installing in a Docker image 

Install: 

apk add --no-cache libressl-dev openldap-dev

Or failing that depends on the version: 

apk add --no-cache openssl-dev openldap-dev

Then install the mongo php driver

pecl install mongod

Create the mongo extension in php:

docker-php-ext-enable mongodb

