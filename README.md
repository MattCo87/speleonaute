# Installation notes

# Installation simplifiée avec notre image docker

(https://hub.docker.com/repository/docker/joelobrecht/speleoalpha)
- `docker container run -d --name speleoalpha -p "1270:80" -v C:cheminversdossier/SpeleoAlpha:/app joelobrecht/speleoalpha`
- Version Windows sans volume `docker container run -d --name speleoalpha -p "1270:80" joelobrecht/speleoalpha`
- `docker start speleoalpha`
- `docker exec -it speleoalpha bash`
- `cd app`
- `composer update`
- `npm install`
- `yarn encore dev --watch`

# The system (installation totale avec container basique)

As mattrayner info on DockerHub is out of date, go see [his github](https://github.com/mattrayner/docker-lamp). There one can see that his latest images are built on php8. Therefore the most suitable image is `latest-2004-php7`.

## Symfony environment installation

- `docker container run -d --name SpeleoAlpha -p "1260:80" -v Chemin\Dossier\Docker\myPC:/app mattrayner/lamp:latest-2004-php7`
- `docker exec it SpeleoAlpha bash` && `cd app`
- `apt install composer` && `composer self-update`
- Installing symfony-cli
  `echo 'deb [trusted=yes] https://repo.fury.io/symfony/ /' | tee /etc/apt/sources.list.d/symfony-cli.list`
  `apt update`
  `apt install symfony-cli`

# New Symfony project

## seulement pour l'installation initial pas pour ceux qui recupere le depot git

            `rm -rfd /app/*` : Emptying the directory
            `symfony new --wabapp .`
            `git config --global user.email "user.mail@mail.com"`
            `git config --global user.name "user.name"`
            `git init`
            `git add .`
            `git commit -m "Initial Commit"`

## fin instalation initial

- Configuring the public folder
  `vim /etc/apache2/sites-available/000-default.conf`

```s
        DocumentRoot /var/www/html/public/
        <Directory /var/www/html/public/>
```

`a2enmod rewrite` (already set up by default)
`service apache2 reload` To point to `app/public`

# Install various tools

`composer require --dev symfony/profiler-pack`
`composer require --dev symfony/var-dumper`
`composer require --dev symfony/apache-pack` Essential for routes to work.

# Install Nodejs / Yarn / Webpack / Encore

`curl -fsSL https://deb.nodesource.com/setup_17.x | bash -`
`apt update` && `apt install nodejs`
`npm install --global yarn` && `yarn install`
`composer require symfony/webpack-encore-bundle`
`npm install -g npm@8.5.3` && `npm install`
`yarn encore dev` Essential or "asset manifest file doesn't exist" Error
`npm run watch` Essential to create the public/build directory and files.

# Make a new controller

- Using Make plugin
- src/WorkersController.php
- Put the php worker retrieval code
- Sent the variable to twig
