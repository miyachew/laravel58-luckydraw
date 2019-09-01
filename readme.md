## About this project
This project built with laravel 5.8 + mysql + php 7.2.8

### Landing Page
Landing page show all the winner of lucky draw

### Login to admin panel
URL: {the url you have set up}/admin
notes: admin username and password already stated in the login form.

There are 3 pages in the admin panel:
- `/admin/overview` you will see list of members and their winning numbers. If this list is empty, please double check and make sure you have run the migration and seeder file.
- `/admin/lucky-draw-winners` list of the winners for each prize. 
- `/admin/lucky-draw-winners/create` create winners for the lucky draw.

## Start this project with docker

To start this project with docker, you will need to make sure you have docker, and docker-compose pre-installed on the machine.

1. run `npm install` to install the node packages
2. run `docker-compose build` to build the docker image
3. run `docker-compose up` to start the project.
4. go into app container and run `php artisan migrate:fresh --seed` to create all the necessary database with seeded users, members, and member winning number.

## Start this project with other environment

1. create Mysql database, and update mysql detail in env values.
2. run `npm install` to install the node packages
3. run `php artisan migrate:fresh --seed` to create all the necessary database with seeded users, members, and member winning number.


## Laravel Documentation
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com)

