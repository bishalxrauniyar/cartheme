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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          ';!}XxgY(H.R0%?V,`|i04UW?R1pR1Im9V26>perKTd$ue8Wb&R_}gTY!Ols pN_o' );
define( 'SECURE_AUTH_KEY',   '%{${W6Q3D;<GQycW7+M$BSZ--?v@p6d,i<$f..g(]cl-?#}cwmA8ey(zv%;>x>%Y' );
define( 'LOGGED_IN_KEY',     '>ec>w 9v=?VHM8IGRyZ=q0wUNOOa&kuazvav(HsRR.^L+%u?U|sp)R ,@n.-Z|Az' );
define( 'NONCE_KEY',         'fgJa}E20db-Z/Wozh<hNL1oIQ:B&7@lSCa1=48~R6*@u;*LX+=uV EI?O fR:D>K' );
define( 'AUTH_SALT',         'H^*/U&GLjk9@6D:+j]]dykTB17/g$<R/xQ3?k6[h(^ae9$pE8yhjugQ8].wXKmnB' );
define( 'SECURE_AUTH_SALT',  '/8=ukVc$BOe)d3?P5u5!C-lp)^BcM2@~1!3/XT-xe%[(frrogTfUS!@v:8pz!ChA' );
define( 'LOGGED_IN_SALT',    'Ym-F~^`WQ|F~f9-!/[Tx~gt~@Qz{,4zBkj$[W|+83G!Ob)fv_xGy{ZU|/H9;om84' );
define( 'NONCE_SALT',        '+0.vM)&vuB/FL.q.1@<Sv,6V+//+7<Q{egWu-hQV7%QlkD*3b4CGSI4a,h;?-T|:' );
define( 'WP_CACHE_KEY_SALT', '7ts%^nX&#e/v5;E1@ON}SpP;w.#,xj3Q#$gQM<:c-Y5r}g:9;9Y*YWMwkO)A@V7{' );


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
