<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// Custom function to get a default for a missing env
function env($name, $fallback = ""){ return (getenv($name) ? getenv($name) : $fallback);}

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', env('DB_NAME', 'wordpress'));

/** MySQL database username */
define( 'DB_USER', env('DB_USER', 'root'));

/** MySQL database password */
define( 'DB_PASSWORD', env('DB_PASSWORD'));

/** MySQL hostname */
define( 'DB_HOST', env('DB_HOST'));

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
#define( 'DB_COLLATE', '' );


/* Multisite */
define('WP_ALLOW_MULTISITE', env('WP_ALLOW_MULTISITE', true));
define('SUBDOMAIN_INSTALL', env('SUBDOMAIN_INSTALL', false));
define('DOMAIN_CURRENT_SITE', env('DOMAIN_CURRENT_SITE', 'localhost'));
define('PATH_CURRENT_SITE', env('PATH_CURRENT_SITE', '/'));
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         env('AUTH_KEY'));
define( 'SECURE_AUTH_KEY',  env('SECURE_AUTH_KEY'));
define( 'LOGGED_IN_KEY',    env('LOGGED_IN_KEY'));
define( 'NONCE_KEY',        env('NONCE_KEY'));
define( 'AUTH_SALT',        env('AUTH_SALT'));
define( 'SECURE_AUTH_SALT', env('SECURE_AUTH_SALT'));
define( 'LOGGED_IN_SALT',   env('LOGGED_IN_SALT'));
define( 'NONCE_SALT',       env('NONCE_SALT'));

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define( 'WP_DEBUG_LOG', ABSPATH . 'wp-content/logs/errors.log');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
	$_SERVER['HTTPS'] = 'on';
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
