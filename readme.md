## Octopus Rest Api Project

This is only a project for Octopus Labs

## Installation Instructions

1)You have to clone this repo to your local environment git clone linktogithubrepo.com/ projectName <br/>
2)run composer install (if you don't have composer already installed you have to install it)<br/>
3)run composer update<br/>
4)copy .env.example and rename it in .env (you can do it manually or with command line cp .env.example .env)<br/>
5)now you have to create your app key so run php artisan key:generate<br/>
6)now run php artisan config:clear<br/>
7)now i have created a custom command to create new database, chage .env settings , then lunch migrate command and create a default user with name:testuser and authtoken=TkpJe8qr9hjbqPwCHi0n for you .You can do that running php artisan db:create<br/>
8)now everything is done, but if you want to have some random data in your db just to start testing i've create a factory to seed db . You can run php artisan db:seed<br/>
9) enjoy<br/>
