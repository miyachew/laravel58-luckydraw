#!/bin/sh

set -e
cd /var/www/application/

# /usr/local/bin/app/confd.sh

# echo '> Run migration...'
# php artisan migrate

echo $START_MESSAGE
touch $LOCK_FILE_PATH