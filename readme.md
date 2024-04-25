# Books Application

## Local Deployment

### Steps
1. Clone the repository.
1. Make sure PHP (>7.4), MySQL and Composer are installed.
1. Run a local MySQL server by running `brew services start mysql`. Root into the server by running `mysql -u root `.
1. Create a database called laravel by running `create database laravel;`.
1. Make a `.env` file from `.env.example`.
1. Generate an APP_KEY by running `php artisan key:generate`.
1. Migrate the Books table by running `php artisan migrate`.
1. Install all dependencies by running `composer install` and `npm install`.
1. Start the development server by running `php artisan serve`. The application can be reached at `http://127.0.0.1:8000`.

## Testing

Run `./vendor/bin/phpunit` to run the suite of tests.

## Docker Setup

### Requirements
- [Docker](https://docs.docker.com/install)
- [Docker Compose](https://docs.docker.com/compose/install)

### Steps
1. Start the containers by running `docker-compose up -d` in the project root.
1. Install the composer packages by running `docker-compose exec laravel composer install`.
1. Run `docker ps` and copy the container id of the Laravel container to be used in the next step.
1. If a local MySQL server is already running, run `docker exec -it <container_id> php artisan migrate` to migrate the table definitions to the database. If not, refer to Step 3 in [Local Deployment](#local-deployment).
1. Access the Laravel instance on `http://localhost` (If there is a "Permission denied" error, run `docker-compose exec laravel chown -R www-data storage`).

Note that the changes you make to local files will be automatically reflected in the container. 

## Persistent database
If you want to make sure that the data in the database persists even if the database container is deleted, add a file named `docker-compose.override.yml` in the project root with the following contents.
```
version: "3.7"

services:
  mysql:
    volumes:
    - mysql:/var/lib/mysql

volumes:
  mysql:
```
Then run the following.
```
docker-compose stop \
  && docker-compose rm -f mysql \
  && docker-compose up -d
``` 