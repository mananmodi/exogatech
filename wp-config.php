<?php
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
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'exogatech' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '@Db(J?mtg]@/d,JzZN5#{CS.n,gA@+sb.#p:@TB{qSkETj>/H8a<{@k5_Z8cLHk_' );
define( 'SECURE_AUTH_KEY',  'Fcpvcv(Y7M3ib=Ei9{@A|Py~|{n/.IaRpo|>nzgGU,)+gV+.O6g9 l},Qnhmp/?&' );
define( 'LOGGED_IN_KEY',    '}v$C{Vw5d+LBh<{:6I`dEysd%=Q{acH~8V}Zvq[[&3Fg&_Yi_$#Qu.4&~p25MTD(' );
define( 'NONCE_KEY',        'w?N3nue;kk9ppE9&S9o+^%W/V17MPzCd9EWd?TmL@rBl?23XjAhXc~ >=LO#-`Dh' );
define( 'AUTH_SALT',        'ST8p9^6E`Ni){O;-`/WGd}{U6L%y)<`B7VrlS]tqJ~HX%s6z84m#~DKVgAqWHH[`' );
define( 'SECURE_AUTH_SALT', '(b~G&f5kfFju$s!jak0+almq*B;jxz=NIqR506V1#UsB(8YY?,^Cy/@r,5T$fDFC' );
define( 'LOGGED_IN_SALT',   '`.T}p:bRgZP0/<>4 =FOI|+agqrK%lNLHObd/ylM5n%;i;bHXu*H2dK;ZP2|d(oL' );
define( 'NONCE_SALT',       'EpURgjIP-L]gbsZ_q_A[!1rMBTE}ts .dt|n!2;Nhs$-R!RpB35*z[zA3&B~{#j8' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'exg_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
