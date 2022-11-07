<?php

declare(strict_types=1);

if (!\defined('ABSPATH')) {
    exit;
}

global $wpdb;
\define('FTLPC_CHARSET', $wpdb->get_charset_collate());

\define('FTLPC_PLUGIN_PATH', \plugin_dir_path(__FILE__));
\define('FTLPC_PLUGIN_URL', \plugin_dir_url(__FILE__));

\define('FTLPC_APP_NAMESPACE', 'FTLPC');
\define('FTLPC_APP_NAME', 'First Time Login Password Change');

\define('FTLPC_APP_CATALOG_NAME', \basename(\dirname(FTLPC_PLUGIN_PATH))); // first-time-login-password-change
\define('FTLPC_APP_TEXT_DOMAIN', FTLPC_APP_CATALOG_NAME); // first-time-login-password-change, we cannot use in __ functions
\define('FTLPC_APP_MAIN_FILE', FTLPC_APP_CATALOG_NAME . '.php');  // first-time-login-password-change.php
\define('FTLPC_APP_MAIN_FILE_PATH', \dirname(FTLPC_PLUGIN_PATH) . DIRECTORY_SEPARATOR . FTLPC_APP_MAIN_FILE);
\define('FTLPC_LOGO_URL', FTLPC_PLUGIN_URL . DIRECTORY_SEPARATOR . 'assets/images/ftlpc.png');
