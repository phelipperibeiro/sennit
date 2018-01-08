#!/bin/sh

chown www-data -R ./sennit_api
chown www-data -R ./sennit_front

chmod -R 775 ./sennit_api
chmod -R 775 ./sennit_front

cp sennit_api/.env.example sennit_api/.env
cp sennit_front/.env.example sennit_front/.env

composer install --working-dir=./sennit_api
composer install --working-dir=./sennit_front
npm install --prefix ./sennit_front


