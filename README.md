# platform-mvp

Stay tuned ...

## Local dev

Docker-compose and VS Code Remote Container environment featuring:
  - mysql8
  - wordpress (alpine/php-fpm)
  - nginx (proxy to wp)
  - wp-cli & composer (devcontainer)
  - mailhog (fake mail)
  - phpmyadmin (db admin)

## Requirements
- Docker
- Docker-compose
- VS Code w/ Remote Containers extension

## Usage

- Open the project in VS Code
- When prompted "Reopen in container" or press F1 -> Remote-Containers: Open folder in container
- Visit `localhost:8000` to see your new WordPress install

## Useful services

### Mailhog
Local mailcatcher for fake email sending. To use it, configure your WordPress install to use the SMTP interface.

Web interface: `localhost:8025`
SMTP interface: `localhost:1025`

### PHPMyAdmin
Web admin for MySQL database.

Web interface: `localhost:8080`
