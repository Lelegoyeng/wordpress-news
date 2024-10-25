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
define( 'DB_NAME', 'isekai' );

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
define( 'AUTH_KEY',         'R-mqhu{Tuo{^&|ajvXNSlPmqYtT3pUdpX=4n~Nf2??&;gq3O=csOb8-e6d`ggWyd' );
define( 'SECURE_AUTH_KEY',  '*[awG#tD+t|D3#*]`L-1pwKa;=7c1E-fMn_)Rlkuy)7|pB?`c27 /gEpt~u4HhIZ' );
define( 'LOGGED_IN_KEY',    'VX#?@k:`=y^uW^,QT}[yQAm$;P=.M, r*k-:IdKpBX cKMA!G?dP{Dglh`d|Vdv5' );
define( 'NONCE_KEY',        '> 12*hFH&s/THAy^8?]c.R=93z>:IFo|{D-|W+D985<qh%JnYrIkPz=xt[IsnkTB' );
define( 'AUTH_SALT',        'OWS1{3x]<g1(bFy=JE&&8SiY`Y+BzwSpj!s$S1 kkzNRw=L/b0W+%-fT6/?&h=T<' );
define( 'SECURE_AUTH_SALT', 'u{V1:6Ogj@YT,Mvo0C<xBY+r#i+Mi)U,44`jGUr+i^?W$&Qz_fKa>`hY|)iHkK~5' );
define( 'LOGGED_IN_SALT',   'U4e6ZWv:d(U}aW7`#1Bt3[Aw5t<IH+}EM6b~QKV{q*j!GTJ._;0G}[AYEIP8gheY' );
define( 'NONCE_SALT',       'jV+5yspy:G--J@];el 5M4ZN9~+hY39? 6>OoQbqFam1)1_h!A/^9hYn)k_qWkes' );

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
