FROM nginx
COPY ./docker/WebApplication/default.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www/application