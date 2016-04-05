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
define('DB_NAME', 'misc_db');

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '[#Zv~~Xy$}xNysbB1i8gNZXujOpDS0sN+VQ+=x7^R6T--!iF~6h8m<S3xo(?Px(`');
define('SECURE_AUTH_KEY',  'A33n|F)U)?AMy!{DiMdyNIv-nFppDU@.-lzAKd}4G}Q!<;?Ww$>]6.SaB{.1O^x)');
define('LOGGED_IN_KEY',    'pc/N*w<gEj5,+prZ:6YECz#RY<?PA(;+%Em;f^=[RhoJCx*Hm*F2Up&vX-whgNdP');
define('NONCE_KEY',        'oTa+sxXgTA-urxXrvTOn5U?=[#>H(|-DWb6(x*n5C&Yr%}=eA`ODw9S#As %83}~');
define('AUTH_SALT',        '%i^%?!{I4`yM/].|}kxtKl/]D}np4 *|,]!v|0aYSuxZ8uR> 2O=iM-+8%x1E|kE');
define('SECURE_AUTH_SALT', 'yx,81BlCu-/<ucBUTT DM*e+%mZ[oK[y^^b/PV6WzxJpO:,vE-~tB?O9Kly6Xfe ');
define('LOGGED_IN_SALT',   'pu[Q5-OSW+6qWucf&+I^2eN$.&OGA?FLV)6!Tah-V ]OTjK%8u._9,C7|(v:)Wgw');
define('NONCE_SALT',       'w0*(JtL&pt:1_L!D*#33V:p|B/AMInk2H7Wp2#bpq:The9eym0N)2~/w,?E<o)tj');

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
