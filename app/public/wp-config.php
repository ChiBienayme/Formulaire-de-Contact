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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+2ej9VVYJjRrOxEuyVkLiz+6Ugcz0+/NW9K2Fdg2pkD0SFfDQI+1mnJDkpFti8Ejo2wVCfWapDkcOAMfCVV32w==');
define('SECURE_AUTH_KEY',  'ntS9oQJEHcQbtJda0Tp4wKDXGPNJaMWuVe2wrex+73Qd2KjPNljBVTRnAfHaI6u4MbFIxkSc6X26BFAOT6A3NA==');
define('LOGGED_IN_KEY',    'QA/qM7lVjJH9eD7yZ7QynQ1f+O9ukGi5ghC3ECNkHIQ7th1WE7QLBkWW6SpM56PNzd6dX2LpmgSXpSpwiUattA==');
define('NONCE_KEY',        'ubV7sKaexaHXbnZnmUWeP7+jojVRasWGUJ9sUZCTpO7qhYY/eFlFGXG2Q70I8N0/9wcN39UmMrq2ExGzpfQH/w==');
define('AUTH_SALT',        'p47aCGJgTFKFST2fzYOYo/OSbWv6PLMlmPSpyYhM2L72nbNFF4BtaE64CYEh3hu/YHqFzyZO1vw4EReZizuu2g==');
define('SECURE_AUTH_SALT', 'kqOk0dHSNV31mxe4dIx7KukN+5RFiS3eD61t8Zx+zYxz/ZVXsYCrF7goFsPBk53Vxg/grpf1wfWHaH5yGPJXZg==');
define('LOGGED_IN_SALT',   'ppKVUv1z9ap+tAkJRWblnDOcO/cVs4xvKpxe2uyhJiUwNIVPW6O68cd99bcd6+x9X3jBbkiEHcMGPDJf60Qfyg==');
define('NONCE_SALT',       '2IvceO/VL/7i6CKNmYPk+NprZdpkSDo5X2WNEEqc5m1nLCu/ZN/ZEwFMb1/8BFSv4AiwKKoM5Cik2b1HGsTxzA==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
