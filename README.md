# About Restaurant Project

This project uses Laravel 9 with `vite` for compiling assets.
  
**Go to the folder application using cd command on your cmd or terminal**
```console
$ composer install
```
- Copy .env.example file to .env on the root folder. You can type copy .env.example .env if using command prompt Windows or cp .env.example .env if using terminal, Ubuntu
- Open your .env file and change the database name (DB_DATABASE) to whatever you have, username (DB_USERNAME) and password (DB_PASSWORD) field correspond to your configuration.
```console
$ php artisan key:generate
$ php artisan migrate --seed
$ npm run dev || npm run build
```

## PDF
**For print to pdf the following package has been used:**   
[barryvdh/laravel-snappy](https://github.com/barryvdh/laravel-snappy)
