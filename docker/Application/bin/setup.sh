#!/bin/sh
# This setup we should use only for DEV/TEST mode

set -e
cd /var/www/application/

#------------------------------------Prepare DEV environment------------------------------------#

echo '> Install dependencies'
php -d memory_limit=-1 /bin/composer install \
            --working-dir \
                /var/www/application

echo '> Set up PHP Code Sniffer...'
#./vendor/bin/phpcs --config-set installed_paths ../../../vendor/squizlabs/php_codesniffer/,../../../vendor/m6web/symfony2-coding-standard/