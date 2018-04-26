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
define('DB_NAME', 'mahanayak');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

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
define('AUTH_KEY',         '#)|6b+@4Zj)LG9%GQ7Vl(BW&iqf*N>2?lo+T]_AZR{l&=}5m/t(SDh}SgC3n%R5&');
define('SECURE_AUTH_KEY',  'OYb[gnq]To*3?!Vff+IsXB>^&UmcvC=g$H_cQc{h=eQVms5?pm9uau=p<,JE;.D$');
define('LOGGED_IN_KEY',    '8YE<Sa_RWIc$)3RgsQqiB6Iu} Kqe~XeK{PO2d7y=1omGBx~V39~0.YlP] jji[(');
define('NONCE_KEY',        'e/%sZT~sO.*VmhqY*CSgPS7 L:m0CDek&SL-UIP<`x:`k<{[#wF^$/NC9&XslVqX');
define('AUTH_SALT',        '1Bk5ZW,= tVS_2;seE+QX:+brSG8 X%_E.[k(*pu&2<h.xFXmJpnx-$$edf99Z@e');
define('SECURE_AUTH_SALT', '{x}E6|mjPZe>V|(!T{T<U+n%cif@9;ii D-l#C7?_b|@m<]9GTNE5BCT&|%oyi?a');
define('LOGGED_IN_SALT',   'A}?bb/c:JMk@*W4ro9m8<vflB=>Q1[EC=C,vSM@~yMR{r(/3S(92Xrm3Wk5<&,Cn');
define('NONCE_SALT',       '|d2LJ-X4]dKE0f|VE& r&LY.9{AVQkN.5HUp-PV7LEes/4ACBSta5x8{W83w[YMX');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mahanayak_';

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
