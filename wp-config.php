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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'a@:L{fc2ia.Hc%QC3P-c2i5CBOoLUUCT!n0.34(3 +]:|rUESm~4CB :c}Q,&y/,' );
define( 'SECURE_AUTH_KEY',  '-6Tle[d&31<1y]{GOEZ,<D&?~;moB_T*o)|W9W1pT@=pkb{M:#Y<E2Q[K}FUylW ' );
define( 'LOGGED_IN_KEY',    'FS3h,/5j&shkvkHI G6=@ena*hmC+9)cYA|0NoO*43Kg?p[e?=,rMMBWBtHm.^a8' );
define( 'NONCE_KEY',        '+:GkhJQTdJJX&4*bzmG!@yxR>uB&{%&=~&u=30iS,>^+Ts[1m+:,-Tuh3k{}!jRl' );
define( 'AUTH_SALT',        'DfvpPoN*92j=epZzQ&:~{ fFQSyzI:ro1QM[79_>=M7~[H}u@K8Aw|{%z/^|xhz|' );
define( 'SECURE_AUTH_SALT', '`#Lb*h|}>O+#=jLp#b.8%b=S?YN}$PxW**;wQxlx!_?BP=t=+EpjV[10 >;= 9!>' );
define( 'LOGGED_IN_SALT',   'B><l&M+.}T,Z]TDj#U,G47deN_(>S=P=e]=uw+%7zGR$Shcz_g6H0s9xQD|qvT01' );
define( 'NONCE_SALT',       'QWxNo+|uFf6*d*SoS}LP%aX$pEnPP,9=26UH~&%2+Wvx4l$(@Z_#~&Nl?#,ic&kR' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'SAVEQUERIES', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
