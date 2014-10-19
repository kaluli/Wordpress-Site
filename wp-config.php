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
define('DB_NAME', 'kalu_wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'kaluli32');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '}|g>XgpRwmpLCR%/T(AuK_cXFS@QvZEbh>Sa&EBj@C|[+<K}-q|S[!WadgZCXX-i@QZyY}n;@Nkost%uC!hjy<&Sz}&fWs}=[PFp}gwu|IQQExYPRg=hy{|iZ>s/?Zqt');
define('SECURE_AUTH_KEY', 'jdemH$UYXxF+wDxsaC@T[[mYAi@U@QG{(!>^SADUIr;|_FZFdfgGrai@QZcK]>ejMag[IvtF=_kNws]g}R<c-/Dl|Z?</He-!-IfKhN}UqJts[zSGFYt/f;>x?dyAt-P');
define('LOGGED_IN_KEY', 'Usk&-LVawZv@B|@PkoX}N%(kuvJo_cl??j)-qQs}Hg+u>GVMb{jhrVfmylF{|VxIqPCst@-EHE>v)hWRbZIKu{HkbwBrkUy{^O;HhZ|sF>beyIFkvjC<M]|}SxI?|${?');
define('NONCE_KEY', 'IikOoXon|)]%_+<P%aeWYy+dO?Y(>gAQZr<vC|MnBUUw$dx|q<Wt&sG?TKxVIpHU+WVJsYqVcy{K_o>gSB*KwO^ln>dhcsJ%/JKph}Lg?S@i{mIRvRh{eDYwtj_kK);=');
define('AUTH_SALT', 'zkj=]N)H=neiIaPLpcs%hu<RGaSMSSF{Q?W/I_D>{l&XxLv!?!&%ui_fgXz$@s}&]kdP-T/=@S!_?Y$SSAb*/c@Ym<nW^hucHpOT@TI(<)?he/ySXMyJ*xm{)[L{Nash');
define('SECURE_AUTH_SALT', 'C?{tsjvWI>w>n)b})jNlSG!WmCd}hZ^^p(c=(z=EvJ)Y}_Rbq=hA[Jre/!VUhR$l<cBs;GHHC{fvnQFQ+=DWGEuPGV?}qce-;I%z(tFdKlFjU)RjNx{s|/*iyvYxb@EF');
define('LOGGED_IN_SALT', '?fsGXvO&/YBqGjnm^y>a$g>ela&c&?hMJYTRFX^(WlwirCbypcV@h@fNXWADk?x_mRc?Plzfa+TKeO$FVushk*CHxjutOF%KT;Eb/>=rkr%*+uSM}&xN!Cb*U>zqlOAm');
define('NONCE_SALT', 'l@eba)HCU<gdAz*kwVgq;B%K%SvJbG<Aua=ReK@OG@)Fj;w^={!UXGyYu$RTmhbcjqj=sSdkK+yg$(>oM_&^gEtRvlL$XSO]S/&;N]hChdWs&&u+Nkw%?kux!eVJJxJh');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_bcmu_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'es_ES');

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
