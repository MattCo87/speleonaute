# Installation SpeleoAlpha

# Installation simplifiée avec notre image docker

L'installation est relativement simple, il faut récupérer notre image docker et la lancer, tirer notre dépôt git (éventuellement choisir sa branche), installer les dépendances php avec composer, les dépendances webpack Encore avec yarn, et compiler les styles et images avec yarn. Voir les instructions à exécuter ci-dessous.

Lien vers notre [image docker](https://hub.docker.com/repository/docker/joelobrecht/speleoalpha).

## Commandes pour l'installation

`docker container run -d --name speleoalpha -p "1270:80" -v chemin_vers_dossier:/app joelobrecht/speleoalpha`

Version sans volume `docker container run -d --name speleoalpha -p "1270:80" joelobrecht/speleoalpha`

- `docker start speleoalpha`
- `docker exec -it speleoalpha bash`
- `cd app`
- `git clone https://github.com/MattCo87/speleonaute .`
- `composer update`
- `yarn install`
- `yarn encore dev --watch`

## Développement rapide sous Windows

Pour développer sans lenteurs sous Windows, il faut créer le container sans volume (les volumes sont très lents sous Windows) et utiliser vscode avec les extensions suivantes :

- Docker : utiliser docker sous vscode
- Remote-WSL : connecter vscode au système Linux du container
- Remote-containers : permet d'accéder facilement aux fichiers du container dans vscode

Commande sans volumes :
`docker container run -d --name speleoalpha -p "1270:80" joelobrecht/speleoalpha`

[Tutoriel Microsoft](https://docs.microsoft.com/en-us/windows/wsl/tutorials/wsl-containers)

# Stack technique

On utilise une image LAMP basique de mattrayner. Attention ses liens sous Dockerhub ne sont pas à jour, utiliser son [github](https://github.com/mattrayner/docker-lamp).

Notre stack technique :

- Linux Ubuntu 20.04
- Apache 2.4
- sqlite3 (php7.4-sqlite3)
- php 7.4
- Symfony 5.4
- Composer
- Yarn
- Webpack Encore
- twig

## Symfony installation initiale

- `docker container run -d --name SpeleoAlpha -p "1270:80" -v Chemin-Dossier-Docker:/app mattrayner/lamp:latest-2004-php7`
- `docker exec -it SpeleoAlpha bash` && `cd app`
- `apt install composer` && `composer self-update`

### Installation de symfony-cli

`echo 'deb [trusted=yes] https://repo.fury.io/symfony/ /' | tee /etc/apt/sources.list.d/symfony-cli.list`
`apt update`
`apt install symfony-cli`

`rm -rfd /app/*`
`symfony new --webapp .`
`git config --global user.email "user.mail@mail.com"`
`git config --global user.name "user.name"`
`git init`
`git add .`
`git commit -m "Initial Commit"`

## Configuration

- Configuring the public folder
  `vim /etc/apache2/sites-available/000-default.conf`

```s
        DocumentRoot /var/www/html/public/
        <Directory /var/www/html/public/>
```

`a2enmod rewrite` (already set up by default)
`service apache2 reload` To point to `app/public`

## Installation des outils

`composer require --dev symfony/profiler-pack`
`composer require --dev symfony/var-dumper`
`composer require --dev symfony/apache-pack` Essential for routes to work.

# Installation de Nodejs / Yarn / Webpack / Encore

`curl -fsSL https://deb.nodesource.com/setup_17.x | bash -`
`apt update` && `apt install nodejs`
`npm install --global yarn` && `yarn install`
`composer require symfony/webpack-encore-bundle`
`npm install -g npm@8.5.3` && `npm install`
`yarn encore dev --watch`
