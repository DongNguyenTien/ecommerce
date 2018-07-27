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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'kuteshop');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );
@ini_set('max_execution_time', 30000);


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'O?UFUd_}I`(_lS{:V`G/0RZdplMbt0J#M-:YwX%ej&4y5N?*uVT6$WKElg`Z]7;)');
define('SECURE_AUTH_KEY',  'icaAM5{W&M/M.W#`HoXuJa=L)t0wX~ij$>!covH(/@j2CmydaZ}U)w)RI$G<@Zyb');
define('LOGGED_IN_KEY',    '+(ucv20c_5#|OBE<j5Zc2c6I85]*7OTlw|1yxr`)ffQFVqg~qT/ZVTWw@kBmMSX8');
define('NONCE_KEY',        'ZOmk5IvIn9>}&CuMQ{n67GIs-xLInl4_y#[yjIy.l<Sj~cR}B{z!BmG-bwLPcA18');
define('AUTH_SALT',        'Pd(ZuWyI>p>iOK,81E)Q%j86ea`S_3&.A-wjlDx=<W)wGmx~)V@be5hof{En#iiZ');
define('SECURE_AUTH_SALT', 'uv4j*U]+6xeeUNPd|-Zta0owXP#MZaiRTfboQ[{2Vr2ev(Rd7|JNGJM fITV  %`');
define('LOGGED_IN_SALT',   'Bo2;IGG`yjL/ avH7]JOwO[,?`s9j`Gy4tp;zj&.cc!I0M37p<`q?^6vyC(O+CZJ');
define('NONCE_SALT',       'A()a}n$eVE`<JUWZO*Mq9BRpn[U>[EuX%yA,tn6Z8TM1iQ27+g22^1$rAACs@u:e');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
