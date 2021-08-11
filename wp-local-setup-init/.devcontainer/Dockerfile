FROM wordpress:latest

RUN set -eux; \
	apt-get update; \
	apt-get install -y --no-install-recommends mariadb-client; \
	rm -rf /var/lib/apt/lists/*

# install Node.js
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - ; \
	apt-get install -y nodejs; \
	rm -rf /var/lib/apt/lists/*;

RUN rm -rf /usr/src/wordpress/wp-content/plugins/akismet &&\
    rm -rf /usr/src/wordpress/wp-content/plugins/hello.php &&\
    rm -rf /usr/src/wordpress/wp-content/themes/*

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
    && chmod +x wp-cli.phar \
    && mv wp-cli.phar /usr/local/bin/wp

# wp theme activate canadian-digital-service
# https://developer.wordpress.org/cli/commands/theme/activate/

# gravity forms
# https://github.com/gravityforms/gravityformscli#installing-and-updating-gravity-forms-and-add-ons

COPY ./entrypoint.sh /entrypoint.sh

ENTRYPOINT ["/usr/bin/env"]
CMD ["bash", "/entrypoint.sh"]