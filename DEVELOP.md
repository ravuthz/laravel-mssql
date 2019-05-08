# Install Auth with JWT

```
composer require tymon/jwt-auth "1.0.*"

php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"

php artisan jwt:secret

php artisan migrate

php artisan make:controller AuthController
```

```
php artisan make:model Room -m
php artisan make:model Schedule -m

php artisan make:controller RoomController -r
```

https://medium.com/employbl/build-authentication-into-your-laravel-api-with-json-web-tokens-jwt-cd223ace8d1a

https://jwt-auth.readthedocs.io/en/develop/laravel-installation/

https://github.com/francescomalatesta/laravel-api-boilerplate-jwt

https://www.sitepoint.com/how-to-build-an-api-only-jwt-powered-laravel-app/

```
php artisan make:resource Users --collection
php artisan make:resource UserCollection


php artisan make:resource RoomResource
php artisan make:resource RoomCollection
php artisan make:resource ScheduleResource
php artisan make:resource ScheduleCollection
```

- admin create account by email and generate password sent to client
- admin can reset password for client
- client can change password, redirect from email body

- mobile login system by email and password get token after success login to api

- one email can limit to login api (2)
- api have only list schedules

