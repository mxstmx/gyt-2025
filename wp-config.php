<?php
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
define( 'DB_NAME', 'wp_is9cr' );

/** Database username */
define( 'DB_USER', 'wp_znzh8' );

/** Database password */
define( 'DB_PASSWORD', '?Y4rF4yUT1DrgW?M' );

/** Database hostname */
define( 'DB_HOST', 'localhost:3306' );

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
define('AUTH_KEY', 'R*6_3@K:R::64hSJ1C0cxI:3-!27Uo*ce;@0cuJ&[_E3X|w~N30/M35(*&Oa0)4Y');
define('SECURE_AUTH_KEY', 'Gps*PC0u1F3Tbk;6iKa4&A|17:3bnMRU(-o0O49Epi892j*hnU0V8gy3qiC502b8');
define('LOGGED_IN_KEY', '_iH6RTGIM8l5QbknMbH9760z/9X5[R!/wEBmoy1I-G-48ioV!678x7gd/-bo|N(R');
define('NONCE_KEY', 'B6k[j940p:QQqv&4NN]R&m-0mQ7we#49~1+1p19;[uvE1/+I0)c!aa_3[+q2ZZC9');
define('AUTH_SALT', '1cFA~S1cNTK*aPDUE!f758pTiT9RM2-s-70!-Q2G7~|FS)@iL0*[1[OsF6~;[2:d');
define('SECURE_AUTH_SALT', 'q|fp]DMf0yK1xe749Y-4KskbV:1F/H0+A9&N/W2_x1XS(!([6SG00M1&q)iR~I0@');
define('LOGGED_IN_SALT', '2@[%COh!!Ek+6p7h35+782ahPej7au(@5c%U*/Q[1:1~)n4RiSdn2m-fFS54T)+2');
define('NONCE_SALT', 'X6)3Y8O1n-L0nxwb]662(0h96*21b]302*[8F#L)yHTTK:4OW]7bX;OWg7k1vf;h');


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wmdmA_';


/* Add any custom values between this line and the "stop editing" line. */

define('WP_ALLOW_MULTISITE', true);
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
