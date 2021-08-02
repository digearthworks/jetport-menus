#!/bin/bash

rm -rf ./laravel-turbine/vendor
rm -rf ./laravel-turbine/node_modules

cp -rn ./laravel-turbine/* .
rm ./composer.lock
rm ./package-lock.json
rm ./yarn.lock

composer update

echo "" >> .env
echo '##############################' >> .env
echo '# New changes below' >> .env
echo '##############################' >> .env
echo "" >> .env

cat .env.example >> .env

php artisan key:generate
php artisan storage:link