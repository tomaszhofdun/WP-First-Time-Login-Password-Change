<?php

/**
 * Plugin Name: First Time Login Password Change
 * Description: Force New Added Users To Change The Password
 * Version: 1.0
 * Author: Tomasz hofdun
 * License: GPL2
 * Text Domain: first-time-login-password-change
 * Domain Path: /App/lang
 * Tested up to: 6.0.0.
 */

declare(strict_types=1);

namespace FTLPC;

if (!\defined('ABSPATH')) {
    exit;
}


// require_once 'Dev/log.php';
require_once 'App/config.php';
require_once 'App/bootstrap.php';
require 'vendor/autoload.php';

App::instance();
