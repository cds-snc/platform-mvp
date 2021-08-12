FROM php:cli-alpine

# Bash
RUN apk add bash

# SSH
RUN apk add --update openssh

# Composer
RUN apk add --no-cache composer

# WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# GIT
RUN apk add git

# Node/NPM
RUN apk add --no-cache nodejs npm

# install sudo
RUN apk add --update sudo

# Create non-root default user
ARG USER=default
ENV HOME /home/$USER

RUN adduser -D $USER \
        && echo "$USER ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USER \
        && chmod 0440 /etc/sudoers.d/$USER

USER $USER
WORKDIR $HOME

CMD ["sleep", "infinity"]