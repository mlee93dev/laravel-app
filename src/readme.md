## Local Deployment

1. Make sure PHP (>7.4), MySQL and Composer are installed.

2. Run a MySQL server by running `brew services start mysql`. Root into the server by running `mysql -u root `.

3. Create a database called laravel by running `create database laravel;`.

4. Make a `.env` file from `.env.example`.

5. Generate an APP_KEY by running `php artisan key:generate`.

6. Migrate the Books table by running `php artisan migrate`.

7. Install all dependencies by running `composer install` and `npm install`.

8. Start the development server by running `php artisan serve`. The application can be reached at `http://127.0.0.1:8000`.

## Testing

1. Run `./vendor/bin/phpunit` to run the suite of tests.