# platform-mvp

Stay tuned ...

## Local dev

Docker-compose and VS Code Remote Container environment featuring:
  - mysql8
  - wordpress (wordpress/apache)
  - wp-cli & composer (devcontainer)
  - mailhog (fake mail)
  - phpmyadmin (db admin)

## Requirements
- Docker
- Docker-compose
- VS Code w/ Remote Containers extension

## Config

Copy the .env.example file to .env and customize as necessary (you might not need to change anything)

```
cp .env.example .env
```

## Usage

- Open the project in VS Code
- When prompted "Reopen in container" or press F1 -> Remote-Containers: Open folder in container
- Visit `localhost:8000` to see your new WordPress install
- Visit `localhost:8000/wp-admin` to see the admin interface

Wordpress will be installed with some pre-configured plugins and themes, and will be configured as a multi-site install. There will also be a default administrator account, with the following credentials:

username: admin
password: secret

## Useful services

### Mailhog
Local mailcatcher for fake email sending. To use it, configure your WordPress install to use the SMTP interface.

Web interface: `localhost:8025`
SMTP interface: `localhost:1025`

### PHPMyAdmin
Web admin for MySQL database.

Web interface: `localhost:8080`

## Plugins and Themes

### Installing
This project is configured to use [Composer](https://getcomposer.org/) to manage [WordPress Themes and Plugins](https://www.smashingmagazine.com/2019/03/composer-wordpress/). 

To install a plugin or theme, find it on [WPackagist](https://wpackagist.org/), add it to composer.json, and run `composer install` or use `composer require [package-name]`. These commands should be run from within the `wordpress` folder.

Note: when starting up the devcontainer or docker-compose, `composer install` is run to automatically install plugins and themes defined in composer.json.

### Creating

When creating a custom plugin or theme, you should prefix the folder name with `cds-`.
