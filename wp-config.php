<?php
/**
 * The base configurations of the WordPress.
 *
 * This file is a custom version of the wp-config file to help
 * with setting it up for multiple environments. Inspired by
 * Leevi Grahams ExpressionEngine Config Bootstrap
 * (http://ee-garage.com/nsm-config-bootstrap)
 *
 * @package WordPress
 * @author Abban Dunne @abbandunne
 * @link http://abandon.ie/wordpress-configuration-for-multiple-environments
 */


// Define Environments - may be a string or array of options for an environment
$environments = array(
	'local'       => array('.local', 'local.'),
	'preview'     => 'yellowpepper.',
);

// Get Server name
$server_name = $_SERVER['SERVER_NAME'];

foreach($environments AS $key => $env){

	if(is_array($env)){

		foreach ($env as $option){

			if(stristr($server_name, $option)){

				define('ENVIRONMENT', $key);
				break 2;
			}

		}

	} else {

		if(stristr($server_name, $env)){

			define('ENVIRONMENT', $key);

			break;

		}

	}

}

// If no environment is set default to production
if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'production');

// Define different DB connection details depending on environment
switch(ENVIRONMENT){

	case 'local':

		define('DB_NAME', 'yellowpep_gevaco');
		define('DB_USER', 'yellowpep_gevaco');
		define('DB_PASSWORD', 's9i3uThv');
		define('DB_HOST', 'localhost');
		define('WP_DEBUG', true);
		define('WP_SITEURL', 'http://gevaco.local');
		define('WP_HOME', 'http://gevaco.local');
		break;

	case 'preview':

		define('DB_NAME', 'yellowpep_gevaco');
		define('DB_USER', 'yellowpep_gevaco');
		define('DB_PASSWORD', 's9i3uThv');
		define('DB_HOST', 'localhost');
		break;

}

// If batabase isn't defined then it will be defined here.
// Put the details for your production environment in here.
if(!defined('DB_NAME'))
	define('DB_NAME', 'yellowpep_gevaco');

if(!defined('DB_USER'))
	define('DB_USER', 'yellowpep_gevaco');

if(!defined('DB_PASSWORD'))
	define('DB_PASSWORD', 's9i3uThv');

if(!defined('DB_HOST'))
	define('DB_HOST', 'localhost');

if(!defined('DB_CHARSET'))
	define('DB_CHARSET', 'utf8');

if(!defined('DB_COLLATE'))
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

if(!defined('AUTH_KEY'))
	define('AUTH_KEY',         'a!W ZA7.[{*^lQ=OO)+d1+-@!wn(Ab}86rHHU(hg+{Y-??-`AT3X,k{)|)TOp=V7');

if(!defined('SECURE_AUTH_KEY'))
	define('SECURE_AUTH_KEY',  'p*Ba-}HK.t)s+!QPA*{?V9J/vQtR]il&c-rbnO19dLfy(uR+-+{Rs|>sM>+%B5pd');

if(!defined('LOGGED_IN_KEY'))
	define('LOGGED_IN_KEY',    'd2=j[2^7PgZ<dllrY$QYe}-4MXH/MI6{b/5Ju7Z7W3cIS^s2YS.+LRW;?WZhPt+]');

if(!defined('NONCE_KEY'))
	define('NONCE_KEY',        'Lo-bJscB-i}cqG%A#ee5HmBp)IkU9Xks#/cOp$?O3nZ|oZM:D-kURaDyC+Fie~=m');

if(!defined('AUTH_SALT'))
	define('AUTH_SALT',        'O{]-og[8gpMvTB{5YS`SJ%dkSG:B3fJ?H|}Wau?Q~l99?ut=+JSjeP-uatEF79?H');

if(!defined('SECURE_AUTH_SALT'))
	define('SECURE_AUTH_SALT', ' ]rF?&svI][];UzjPB=$zM(T|P?7HP~+tfQd`KY0)wO%^^3[I:Pppi^tq2$%*232');

if(!defined('LOGGED_IN_SALT'))
	define('LOGGED_IN_SALT',   'ikT=c5l)r&2,)ty}_|DO;a{-&g$>O|~piMl.+_G#De+{Q9ncp~!mu]Sv+=*b81IO');

if(!defined('NONCE_SALT'))
	define('NONCE_SALT',       'EI)IhFKh$+T oT};-`l2g8[Z8Hoyk*b^VkW_fS84f2o%zTH])VX5zLHBR0x$Z#^N');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
if(!isset($table_prefix)) $table_prefix  = 'ge_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
if(!defined('WPLANG'))
	define('WPLANG', 'nl_NL');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
if(!defined('WP_DEBUG'))
	define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
