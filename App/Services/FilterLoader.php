<?php

declare(strict_types=1);

namespace FTLPC\Services;

use FTLPC\Singleton;

if (!\defined('ABSPATH')) {
    exit;
}

class FilterLoader
{
    use Singleton;

    private function __construct()
    {
        \remove_filter('authenticate', 'wp_authenticate_username_password', 10);
        \remove_filter('authenticate', 'wp_authenticate_email_password', 10);
        \add_filter('authenticate', [$this, 'custom_authenticate'], 30, 3);
    }

    public function custom_authenticate($user, $username, $password)
    {
        if (!\is_wp_error($user)) {
            $currentuser = \wp_authenticate_username_password($user, $username, $password);
            /** Check if record ftlpc_first_reset exist for loged in user */
            $if_user_first_loged = \get_user_meta($user->ID, 'ftlpc_first_reset');
            if ('true' == \get_site_option('ftlpc_plugin_active') && !\count($if_user_first_loged) && 'administrator' !== $user->roles[0]) {
                \ftlpc_reset_pass_form($user);
                exit;
            }

            return $currentuser;
        }
    }
}
