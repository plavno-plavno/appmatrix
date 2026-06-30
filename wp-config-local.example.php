<?php
/**
 * Local-only WordPress overrides.
 *
 * Copy this file to wp-config-local.php and adjust values for your Open Server
 * environment. This file is loaded automatically by wp-config.php when present.
 */

define( 'DB_NAME', 'appmatrix' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );

/**
 * If your imported dump uses another prefix, keep the original one from
 * wp-config.php. Only change this if your local tables actually use
 * a different prefix.
 */
$table_prefix = 'CD6f7c1_';

/**
 * Optional local URL overrides.
 */
define( 'WP_HOME', 'http://appmatrix/' );
define( 'WP_SITEURL', 'http://appmatrix/' );

/**
 * Optional local debugging.
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
