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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'XDQskzl0uc+fS+0Gz1uTqcxfzwi4l359CuGftKFve0rm4trBgOisJbGr1HSLgavm/pZpLaHFTkmcpW8QVRiqsw==');
define('SECURE_AUTH_KEY',  'iDiOMhhuqzqMzZf2S/aXRKBfXYb+CZ4jNL1tjXd2IkaNWy70Pbw4Worcx1n22eiEba7Yj3867tUkni1OoL2ipA==');
define('LOGGED_IN_KEY',    'lyXm05ecqnl6UgdoKR3KVVjtudQX5TY8lPQDeGxWZmS6XYPsRZO/o+nn0JcQXogSrNUD/cUrHtCrS+UoTOAfBw==');
define('NONCE_KEY',        'IE73CSao0unQZZF/y7MQHO4zC8k+V2i5loz3JSNyhBDKyf1/6KQDyB4Za2HSpNCQNCfsH5QtKRkQEGlEIG83rw==');
define('AUTH_SALT',        'Es60uDvZZonmlN28WJ7UZG0YX7lx+ekiHPXMAI1o+2DSocASn2bPiHq5C+3YcfYS4IeVGTDIfDmXNhtBlq09SA==');
define('SECURE_AUTH_SALT', 'Z2HBWbJ25TuMxYE9u2YV3vsuCVZ0qMxRkzyWu36WrLRWyz6jU8aTBGcJ6XUpLRwvd8Qb6E84GAL4dcuNhAJ9Fg==');
define('LOGGED_IN_SALT',   'sPWQhtxYdC+lysHYjKgOACWwWnciOArIBBrDe7Me5hkt5H2ifB4VpBZeTaLvgaCbKapzIuCmwxYFyrk2k2tq2Q==');
define('NONCE_SALT',       'Z5Qbu30WlN4eXlDROvrzbCVGUa2H/ya5n65gKls6RNIMXITqLC8p4wkK1mFVnLg+ofFc8F1AOhq/xhZKi5jyug==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_1kdcin6tu6_';





/* Inserted by Local by Flywheel. See: http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy */
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

/* Inserted by Local by Flywheel. Fixes $is_nginx global for rewrites. */
if ( ! empty( $_SERVER['SERVER_SOFTWARE'] ) && strpos( $_SERVER['SERVER_SOFTWARE'], 'Flywheel/' ) !== false ) {
	$_SERVER['SERVER_SOFTWARE'] = 'nginx/1.10.1';
}
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
