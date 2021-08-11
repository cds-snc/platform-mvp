#!/bin/bash
set -e

if [ -n "$MYSQL_PORT_3306_TCP" ]; then
	if [ -z "$DB_HOST" ]; then
		DB_HOST='mysql'
	else
		echo >&2 'warning: both DB_HOST and MYSQL_PORT_3306_TCP found'
		echo >&2 "  Connecting to DB_HOST ($DB_HOST)"
		echo >&2 '  instead of the linked mysql container'
	fi
fi

if [ -z "$DB_HOST" ]; then
	echo >&2 'error: missing DB_HOST and MYSQL_PORT_3306_TCP environment variables'
	echo >&2 '  Did you forget to --link some_mysql_container:mysql or set an external db'
	echo >&2 '  with -e DB_HOST=hostname:port?'
	exit 1
fi

# if we're linked to MySQL, and we're using the root user, and our linked
# container has a default "root" password set up and passed through... :)
: ${DB_USER:=root}
if [ "$DB_USER" = 'root' ]; then
	: ${DB_PASSWORD:=$MYSQL_ENV_MYSQL_ROOT_PASSWORD}
fi
: ${DB_NAME:=wordpress}

if [ -z "$DB_PASSWORD" ]; then
	echo >&2 'error: missing required DB_PASSWORD environment variable'
	echo >&2 '  Did you forget to -e DB_PASSWORD=... ?'
	echo >&2
	echo >&2 '  (Also of interest might be DB_USER and DB_NAME.)'
	exit 1
fi

if ! [ -e index.php -a -e wp-includes/version.php ]; then
	echo >&2 "WordPress not found in $(pwd) - copying now..."
	if [ "$(ls -A)" ]; then
		echo >&2 "WARNING: $(pwd) is not empty - press Ctrl+C now if this is an error!"
		( set -x; ls -A; sleep 10 )
	fi
	tar cf - --one-file-system -C /usr/src/wordpress . | tar xf -
	echo >&2 "Complete! WordPress has been successfully copied to S$(pwd)"
fi

# TODO handle WordPress upgrades magically in the same way, but only if wp-includes/version.php's $wp_version is less than /usr/src/wordpress/wp-includes/version.php's $wp_version

TERM=dumb php -- "$DB_HOST" "$DB_USER" "$DB_PASSWORD" "$DB_NAME" <<'EOPHP'
<?php
// database might not exist, so let's try creating it (just to be safe)

$stderr = fopen('php://stderr', 'w');

list($host, $port) = explode(':', $argv[1], 2);

$maxTries = 10;
do {
	$mysql = new mysqli($host, $argv[2], $argv[3], '', (int)$port);
	if ($mysql->connect_error) {
		fwrite($stderr, "\n" . 'MySQL Connection Error: (' . $mysql->connect_errno . ') ' . $mysql->connect_error . "\n");
		--$maxTries;
		if ($maxTries <= 0) {
			exit(1);
		}
		sleep(3);
	}
} while ($mysql->connect_error);

if (!$mysql->query('CREATE DATABASE IF NOT EXISTS `' . $mysql->real_escape_string($argv[4]) . '`')) {
	fwrite($stderr, "\n" . 'MySQL "CREATE DATABASE" Error: ' . $mysql->error . "\n");
	$mysql->close();
	exit(1);
}

$mysql->close();
EOPHP

echo >&2 "Doing multisite install"
wp core multisite-install --title="Welcome to the WordPress" --admin_user="admin" --admin_password="password" --admin_email="admin@example.com"  --allow-root

exec "$@"

apache2-foreground