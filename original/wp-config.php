<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'enlafinc_wor4972');

/** MySQL database username */
define('DB_USER', 'enlafinc_wor4972');

/** MySQL database password */
define('DB_PASSWORD', '4ZmI9qGscQxZ');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', 'Nj!GMD!Ze(X@u{flFg_?B]t{A/Pz|Hkw(?@pOtIw@BOQa|WRYNp}<IIg%k/[{=R+@n&xP@{NatFWs&Cn>i<fnpnKDMuMl&%brGUXgUgXYAVZT^QdvK)R=}a?XB^=bs|]');
define('SECURE_AUTH_KEY', 'FqEJjq=DL-Fow%iIqS)Vpn[FT?d*;gIyX&jgY=[V+s=]ltRCQh]/[rV?HiVwf@p*e]=bOw)ARcu%]yNiRC[yJoskE!NkUj]ij;IQu-UB!Z!>m)lBRl@_%/R;<uNy%_[[');
define('LOGGED_IN_KEY', 'KMBvS/HzFLyOD;r)P)}/$_UfTc;D]yXXY!<eZA!tHQNd^_EkN?aSh{*as<zek_$I&M>nLTIvOXJY&@WyJ|Zv-+[qG_gMm+%/W%rrr[PH|EKWBD?QrqXAtz(GjDo=BIu>');
define('NONCE_KEY', 'Sg;$aZW+nqvqZu}O|N*K@Qv%uipo&]CajMGhvgrU-JFg*?h$+B|iE=piF|bd@;?RRaxCpu[EIP!=va]r;R+Zoc=suZ+Kb$cszXTErPDET+b-asnnodyasehdRzRhj]]X');
define('AUTH_SALT', 'eI{^>Cst<@vv!x*RUXFOER+fqUFCYtDe;?OSZ$x?Jsi-tu>N|d-)<UMwF>p&)!@IBY$*=%FYeKFh){wDSqn{>[$aYCHQvrK/cv*$UXejL$YppYDb%mKCRfgf?BTsd@]w');
define('SECURE_AUTH_SALT', 'bIESQ[kThb^sj]CM!%*(UfA[$>r&mVqo{+{<zO=|ccE%&Naq[Bya+}Aa<lA([^A=BVTwG_m+(]p@D^lsgL*jdQvmxOuyl!c%t]<;d<G-+K<|dQ[q(a|u-IObgIRhtb%<');
define('LOGGED_IN_SALT', 'M^riJWn!akiSeFo>)M[P^jaLp?Z>hl^@-?=@]^/NtjtBGOT/s{;@(nxdj?(_VlWZC)GShaBGO^F*u)|&|rFBMY>gw@UjkYSKRSuw(X)^r>tokRWtwi;L(YPSfy!/Kvk&');
define('NONCE_SALT', 'Me(De}NHCv=QFK%}_M(G=f^_Dq(|D+^PKDFHKdsSAK/r$pqRaTumxaiZK/(ydi*ozJgUoM(RT|vb(wQw|}cP^kM}=deAjeS_QRzmft=$iM_;_WNh^XKm}g|GoqbUUh<*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_abzr_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}
