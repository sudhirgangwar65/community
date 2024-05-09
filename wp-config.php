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

 * * ABSPATH

 *

 * @link https://wordpress.org/documentation/article/editing-wp-config-php/

 *

 * @package WordPress

 */



// ** Database settings - You can get this info from your web host ** //

/** The name of the database for WordPress */

define( 'DB_NAME', 'db6ssmyvc03nie' );



/** Database username */

define( 'DB_USER', 'uagbd4vmrnqhh' );



/** Database password */

define( 'DB_PASSWORD', 'Ninja@#123' );



/** Database hostname */

define( 'DB_HOST', 'localhost' );



/** Database charset to use in creating database tables. */

define( 'DB_CHARSET', 'utf8mb4' );



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

define( 'AUTH_KEY',         'JW=.{.{BHPIn~5`>9>!w4t)~51<DkN5t.4dzW2N?Z.NSvl=az#&}VE`O!EP7Kv-;' );

define( 'SECURE_AUTH_KEY',  's?S9<PMiDWmGh>)Yq![)KXs 34W4bQX/=h}N{jbM%M&kR~HQ6bm!tkFa!]qeq#f=' );

define( 'LOGGED_IN_KEY',    '$pc9~UFkCO*0Y0I1a!jrj4g%|~WX@q{J=z1 r$d?`e+~`_w<>I/jxgrKv+S4tFGk' );

define( 'NONCE_KEY',        'Oyl.28>7$AhM>|PYJ$`NL4%n<Q4[eA$S3U,;_}s@Av4RtZq=6Wq?7Q3O29`&LWTA' );

define( 'AUTH_SALT',        '_HgI%ZAh TLY.%np1<[#n8kCiHbpsB+<hik=IOLM~:ijX#w/pK(=t}/&]:bLP(q^' );

define( 'SECURE_AUTH_SALT', '];%Y~[cbA^![rq}P{/9K.Tx(taj(Z]JuC,487xS[Iw7tp6w03`v[BK7U1V7@w.Sv' );

define( 'LOGGED_IN_SALT',   'Y))7NQi8NrHpNf+n3WK)Z6x1CGM:D#8$J4TkfNp.r!ln7vJ:<u9P(Tsp%h!?uC@D' );

define( 'NONCE_SALT',       '?HL.rkmKMdvRa*V%O1T9eSCmuTK l}blndwxEG Z-A;22#o,vMujBr%`w`9Oa?F&' );



/**#@-*/



/**

 * WordPress database table prefix.

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

 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/

 */

define( 'WP_DEBUG', true );

define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}

/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';