### If you are using Docker
```shell
docker-compose build
```
```shell
docker-compose run --rm composer install
```
```shell
docker-compose run --rm php vendor/bin/behat
```

### If you are NOT using Docker
```shell
composer install
```
```shell
php vendor/bin/behat
```