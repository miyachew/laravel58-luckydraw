FROM php:7.2.8-fpm-alpine3.7

RUN apk update
RUN apk add --no-cache $PHPIZE_DEPS imagemagick imagemagick-dev git icu-dev openssl-dev zip unzip libpng-dev python3 py-pip
RUN rm -rf /var/lib/apt/lists/*

COPY ./docker/Application/php/php.ini /usr/local/etc/php/conf.d
COPY ./docker/Application/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN pecl install imagick-3.4.3 && \
    docker-php-ext-enable imagick && \
    docker-php-ext-install -j$(nproc) intl && \
    docker-php-ext-install mysqli && \
    docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-install zip && \
    docker-php-ext-install gd && \
    docker-php-ext-install pcntl

ENV TERM dump
ENV START_MESSAGE Application has been installed
ENV LOCK_FILE_PATH /tmp/application.lock

COPY ./docker/Application/bin /usr/local/bin/app
COPY . /var/www/application
COPY docker/Application/confd /etc/confd

RUN chmod +x /usr/local/bin/app/* && \
    mkdir -p /var/www/application/storage && \
    chown -R www-data:www-data /var/www/application/storage

RUN sed -i "s/www-data/root/g" /usr/local/etc/php-fpm.d/www.conf

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php -r "if (hash_file('SHA384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"


# create directories and files in case empty directories weren't copied
RUN mkdir -p /var/www/application/storage/framework/cache && \
    chmod -R 775 /var/www/application/storage/framework/cache/ && \
    mkdir -p /var/www/application/storage/framework/sessions && \
    chmod -R 775 /var/www/application/storage/framework/sessions/ && \
    mkdir -p /var/www/application/storage/framework/views && \
    chmod -R 775 /var/www/application/storage/framework/views/ && \
    mkdir -p /var/www/application/storage/cache/ && \
    chmod -R 775 /var/www/application/bootstrap/cache/ && \
    mkdir -p /var/www/application/storage/logs && \
    touch /var/www/application/storage/logs/laravel.log && chmod 777 /var/www/application/storage/logs/laravel.log

RUN php -d memory_limit=-1 /bin/composer install \
        --no-ansi \
        --prefer-dist \
        --no-interaction \
        --no-progress \
        --no-scripts \
        --optimize-autoloader \
        --working-dir \
            /var/www/application

WORKDIR /var/www/application

CMD /usr/local/bin/app/run.sh
