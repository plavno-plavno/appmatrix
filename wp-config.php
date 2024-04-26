<?php
//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL cookie settings

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

//TODO
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG_DISPLAY', false);
define( 'WP_HOME', 'https://qatsol.bi' );
define( 'WP_SITEURL', 'https://qatsol.bi');

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\OSPanel\domains\qatsol.bi\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'qatsol' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Em0S2hIxeUJ9qI9tbQkYQUUwwxvOjfbAs7bSl8c0NmsYHOxUVyDmUTGJYV4Whzyk');
define('SECURE_AUTH_KEY',  'skAStMmp2CQtaGCHHywqgMTpAOVoC3YPxp8PBOrhlsFKOQHqnxp2qFRqKFKlX2xH');
define('LOGGED_IN_KEY',    'TvnYU25eWFy8aXSh6KcWlR887X27Smpe38SkWzTJdo6EAm7igJxs77bRBTjihSVO');
define('NONCE_KEY',        'sGO3KivQrVAPCQuhApFeTffJdFE1UzW5DRFBNSXibWn6MXAOkA3ETvKp3YzkOC9P');
define('AUTH_SALT',        'ue0t8QfopMxKoTkFq0cPmJLZUX79Hl6ji0n5BknW8u3XYmKjABpjUyNBhOFWKJGd');
define('SECURE_AUTH_SALT', '1tE0cLHM7AeFQwsrCwiWhy1V8nkntPjzpuk0KU0nxBwG7RLE0i0XCbUkW1wolHNu');
define('LOGGED_IN_SALT',   'IupQ26P7egF1OgIDj2Xtbn0C2vR36uM46QNErRB9h5U45kqX5aoBbimwW0MG2Vc1');
define('NONCE_SALT',       'ZkrkcsGOpbJ9TQtLnSOM44FMG7wkRriMC6wptHDVbAG3MxigyRvAMzCTYMLaixNL');

/**
 * Other customizations.
 */
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'CD6f7c1_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
