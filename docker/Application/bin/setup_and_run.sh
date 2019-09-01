#!/bin/sh

set -e
cd /var/www/application/

/usr/local/bin/app/setup.sh
/usr/local/bin/app/pre_run.sh

php-fpm -RF