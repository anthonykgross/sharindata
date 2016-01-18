#!/bin/bash
set -e

chmod 777 * -Rf

rm node_modules/ -Rf
rm app/cache/* -Rf

npm install
gulp

php composer.phar self-update
php composer.phar install

php app/console assets:install

chmod 777 * -Rf

supervisord