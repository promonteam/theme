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
define('DB_NAME', 'promon');

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
define('AUTH_KEY',         '3(^jWe?^uy?b#M4tSGWtbsNP]nTx6?,vu1//b2cmch}~%e,HZ:]6;+l0OJ>L-1z=');
define('SECURE_AUTH_KEY',  'H$84>Wa6kwXc$QEL-V+$4r`,~ %Ns#L34@,Eukh7st#jYC^Wf:n/01n8haFbLl./');
define('LOGGED_IN_KEY',    '#Ro[RAXlkH2-`2]jsqboKNcgS;5|BaZ0GpG6wiwf?yztldMp}RX~J?PO#>XdFy$|');
define('NONCE_KEY',        '1cCnRJc88b[RnS%8e1,_JqZLL)[Q$>EnEukgSB_:|}U~4FLA_MOMPz/*]/dO1a:c');
define('AUTH_SALT',        ';JqO0!LbA_/{p9{60tUoc8uO?6!*vz;_[6Zv(T6I4!|hM~33%>G~kA@@05s.k_k$');
define('SECURE_AUTH_SALT', ';EM#aiCYw.upu=OJg`>~wTxZY_<al_&RaQGlu)JgydCee:%N#2fe/p|q#Y2lvlC^');
define('LOGGED_IN_SALT',   'tO%2cn6C!yx%4[P ]TQaAxTwSL8sKi:qw+i2jD][-O>,);9_i DY/C?aLJ}VZ(kE');
define('NONCE_SALT',       '*$Z_AgA+Zj&mq`5)HVet[78l_M*C(;m>i.b%4XVsrI0LfwLPFA*,<OUVb?lqkL ^');

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
