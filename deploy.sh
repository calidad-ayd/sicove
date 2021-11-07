#!/usr/bin/env bash

git fetch
git reset --hard @{u}

composer install

sudo npm ci

npm run dev

php artisan migrate

chown -R www-data: .

systemctl restart php7.4-fpm
