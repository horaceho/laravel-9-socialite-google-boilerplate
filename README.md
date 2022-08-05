## Laravel 9 Socialite (Google) Boilerplate

### Install
```bash
git clone laravel-9-socialite-google-boilerplate.git social
cd social
cp .env.example .env # and setup .env
# create database
# setup APP_URL
# setup DB_DATABASE, DB_USERNAME, DB_PASSWORD
# GOOGLE_CLIENT_ID=
# GOOGLE_CLIENT_SECRET=
composer install
php artisan key:generate
php artisan storage:link
php artisan migrate
```

### Start serve and open browser
```bash
php artisan serve
open http://127.0.0.1:8000 # in a browser
```

### Route List (Auth)
```bash
php artisan route:list --path=auth
```

## Copyright

&copy; 2022 [Horace Ho](https://horaceho.com)
