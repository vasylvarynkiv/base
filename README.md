# BASE LARAVEL APP

## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites
```
Docker
```

### Installing

Copy all environment files
```
cp env-laradock-local laradock/.env
cp .env.example .env
```

Run docker commands
```
cd laradock
docker-compose up -d nginx mariadb
docker-compose exec --user=laradock workspace bash
composer install
php artisan migrate --seed
npm i 
npm run dev

php artisan event:generate
php artisan event:cache
```

Generate JWT Secret
```
php artisan jwt:secret
```

Generate API Docs
```
php artisan l5-swagger:generate
```
or change ENV key L5_SWAGGER_GENERATE_ALWAYS to ```true```

## Usage

Run containers
```
cd laradock
docker-compose up nginx mariadb
docker-compose exec --user=laradock workspace bash
npm run production or der or watch
```

Now you can open
* [http://localhost/](http://localhost/)

Open container console
```
docker-compose exec --user=laradock workspace bash
```

Reset Database
```
php artisan migrate:refresh --seed
```
