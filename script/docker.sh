#!/bin/sh

docker-compose \
  -f ./docker/mariadb-10-5/service.yaml \
  -f ./docker/php-fpm-8-2/service.yaml \
  -f ./docker/nginx-1-25/service.yaml \
  -f ./docker/mailhog/service.yaml \
  --env-file ./docker/.env \
  $*
