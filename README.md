# Flame Game
## Getting started
- First, install the dependencies
```shell
docker run --rm \
-u "$(id -u):$(id -g)" \
-v "$(pwd):/var/www/html" \
-w /var/www/html \
laravelsail/php83-composer:latest \
composer install --ignore-platform-reqs
```
- Next, create and copy .env.example file to a .env file and fill in the variables' values

- Next, run the following command to generate the app key in your env file
```shell
./vendor/bin/sail artisan key:generate
```
- Finally, boot up the project
```shell
./vendor/bin/sail up
```
## Useful commands
To execute any command, prefix it with:
```shell
./vendor/bin/sail
```

See list of artisan commands:
```shell
./vendor/bin/sail list
```
