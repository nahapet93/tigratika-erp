# Tigratika test project

- Pull Laravel project from git provider.
- Rename `.env.example` file to `.env`inside your project root and fill the database information.
- Open the console and cd your project root directory
- Run `composer install`
- Run `npm i`
- Run `php artisan key:generate`
- Run `php artisan migrate`
- Run `php artisan db:seed` to run seeders, if any.
- Run `npm run dev`
- Run `php artisan serve`

## With Docker

- Run `./vendor/bin/sail up`
- Run `./vendor/bin/sail artisan migrate`
- Run `./vendor/bin/sail artisan db:seed`
