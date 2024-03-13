# Flame Game

Web application built on laravel sail with mysql and redis.

## Getting started

1. First, install the dependencies
    ```shell
    docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
    ```
2. Create and copy .env.example file to a .env file
3. Boot up the project
    ```shell
    ./vendor/bin/sail up
    ```
4. Install npm dependencies
   ```shell
   ./vendor/bin/sail npm install
   ```

5. Migrate and populate the database
    ```shell
    ./vendor/bin/sail artisan migrate --seed
    ```

6. Finally, generate the app key in your env file
    ```shell
    ./vendor/bin/sail artisan key:generate
    ```

And you're good to go!

## Useful commands

To execute any command, prefix it with:

```shell
./vendor/bin/sail
```

See list of artisan commands:

```shell
./vendor/bin/sail list
```
