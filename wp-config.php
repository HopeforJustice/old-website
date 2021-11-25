<?php
/**
 * The base configurations of the WordPress.
 *
 *
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

/**
* Define type of server
*
* Depending on the type other stuff can be configured
* Note: Define them all, don't skip one if other is already defined
*/

define( 'DB_CREDENTIALS_PATH', dirname( ABSPATH )  ); // cache it for multiple use
define( 'WP_LOCAL_SERVER', file_exists( DB_CREDENTIALS_PATH . '/local-config.php' ) );


/**
* Load DB credentials
*/

if ( WP_LOCAL_SERVER )
    require DB_CREDENTIALS_PATH . '/local-config.php';
else
    require DB_CREDENTIALS_PATH . '/production-config.php';


/**
* Authentication Unique Keys and Salts.
*
* Change these to different unique phrases!
* You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
* You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
*/

if ( ! defined( 'AUTH_KEY' ) )
    define('AUTH_KEY', 'hO#yn]9R Q>FG8d6bPmdQ}ym%NGv-f+hjVS^Qp>)6arxr3@8=aCqgVQ:!XjzF;,!');
if ( ! defined( 'SECURE_AUTH_KEY' ) )
    define('SECURE_AUTH_KEY', 'LoE~A):0Zu9 H,E9ZoMAIN}l^%:W(fiXQ2]vyl$J4uV{NCX&*?SukYCM%]3c;%O<');
if ( ! defined( 'LOGGED_IN_KEY' ) )
    define('LOGGED_IN_KEY', 'j|Gjtw9Y&, &S<A(|WtK7|%8=P=&+#sz#_-P+_-kkjZrDzJ&b$+^J-HTCa>5J% f');
if ( ! defined( 'NONCE_KEY' ) )
    define('NONCE_KEY', 'RG|lRG(33]M?;x-!Cmklz7et>`m_z576_$zg}o^=B{wDU4A6F@=5vh1o-5{v52[[');
if ( ! defined( 'AUTH_SALT' ) )
    define('AUTH_SALT', 'L!5RhGGA_Ff4Bdyh#OjpTLg;f2?fm)#DW&+c!)s!Cgd~!fc>=w||8o|i}2r:n))`');
if ( ! defined( 'SECURE_AUTH_SALT' ) )
    define('SECURE_AUTH_SALT', 'UftTpf8>F;=E}q96Aak+5.xe]gS_wFzs`][54qE-#D<GE,Dd%<.{yMPmv7Hc%W2h');
if ( ! defined( 'LOGGED_IN_SALT' ) )
    define('LOGGED_IN_SALT', '!-^})e+i*!Mi{S9|D~ 8Y|W77Q >6A<-4VD~gL.u_!GbzbpnzyMW)qp4k#JZ$ch|');
if ( ! defined( 'NONCE_SALT' ) )
    define('NONCE_SALT', 'aKJ?JU{ww`@#D|>H1[]<>+;oh*}&$1Xjm,@NlZ+r!IZtZi|Ps6s_yph|6<v-Sa%b');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wphfj_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
/**
* For developers: WordPress debugging mode.
*
* Change this to true to enable the display of notices during development.
* It is strongly recommended that plugin and theme developers use WP_DEBUG
* in their development environments.
*/

if ( WP_LOCAL_SERVER ) {
    define( 'WP_DEBUG', false );
    define( 'WP_DEBUG_LOG', true ); // Stored in wp-content/debug.log
    define( 'WP_DEBUG_DISPLAY', true );

    define( 'SCRIPT_DEBUG', true );
    define( 'SAVEQUERIES', true );

    define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/core');
    define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
    define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'].'/build');
    define('WP_CONTENT_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/build');



} else {

    define( 'WP_DEBUG', false );
}

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');



/* That's all, stop editing! Happy blogging. */