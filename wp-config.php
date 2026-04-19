<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u617448022_BEJdG' );

/** Database username */
define( 'DB_USER', 'u617448022_vvGdu' );

/** Database password */
define( 'DB_PASSWORD', 'zzJhkAevx3' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '_qgdr){)9o-QP68sG tI|8-5 .>tHr^9Hz75M+wQi1pUFN@$g6ESB~,O{I.=Xv$?' );
define( 'SECURE_AUTH_KEY',   '4|2Ky}![Wd~hE]xusK!@e~b>%{jW=m=clVLG|8iRFNrC<D>Q7zo#Kou1OBtMd[}O' );
define( 'LOGGED_IN_KEY',     'u/MLs2`%8B1Bbbov-dhamqc~F67yB;lVH^wg9s53r{pNxc0J4d5OLU^S.!&!X7+E' );
define( 'NONCE_KEY',         ':2NYtrsZ;$dY|%ausT6[8anTZ]Y^4c6B`}5S9#(dC3[w=1RZQ@[O=EnTf{i+V&5j' );
define( 'AUTH_SALT',         'Q;H4a3EY_[k/wM_hZZM=oMrCsI9^jm&H_UEpw)h:dU@jZ!!&0[~UrhU56W#UF<.;' );
define( 'SECURE_AUTH_SALT',  '8J~P$]6s<!Gvo5iEB=Z0VrmRB=|Vs_+/!g{J8VYuW83=L9GUPb=FJE{W{!!@$,^N' );
define( 'LOGGED_IN_SALT',    '[Ymd@5!(Aj:*},ZDW9u$<vjkYGS&kZsZ)wbY!w<~.~OgQ:*yUAst*%GKj[kC(BdT' );
define( 'NONCE_SALT',        'hpUi Cqoj)FEj8&NPMv=/g~XWS:HzqX$/ Nr-1*UM&.[iR<[=e$&3^pq;_])B<;}' );
define( 'WP_CACHE_KEY_SALT', 'c>n`Mr_L0T_ 0~_SO%W4ov-eIgg5ZGa<N9T]hmW|%b]EYjI7{8A)P|OHD$HtpGDo' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '3068f1273b2cd7cbec8765dc4c968f6a' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
