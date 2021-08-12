FROM php:cli-alpine

# install sudo
RUN apk add sudo

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

# ZSH
RUN apk add zsh zsh-autosuggestions zsh-syntax-highlighting \
    rm -rf /var/cache/apk/*

# Create non-root default user
ARG USER=default
ENV HOME /home/$USER

RUN adduser -D $USER \
        && echo "$USER ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/$USER \
        && chmod 0440 /etc/sudoers.d/$USER

USER $USER
WORKDIR $HOME

# Oh-my-zsh
RUN sh -c "$(wget https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh -O -)"
RUN echo "source /usr/share/zsh/plugins/zsh-syntax-highlighting/zsh-syntax-highlighting.zsh" >> ~/.zshrc && \
    echo "source /usr/share/zsh/plugins/zsh-autosuggestions/zsh-autosuggestions.zsh" >> ~/.zshrc

ENV SHELL /bin/zsh

CMD ["sleep", "infinity"]