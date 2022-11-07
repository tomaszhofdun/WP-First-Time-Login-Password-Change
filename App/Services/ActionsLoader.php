<?php

declare(strict_types=1);

namespace FTLPC\Services;

use FTLPC\Singleton;

if (!\defined('ABSPATH')) {
    exit;
}

class ActionsLoader
{
    use Singleton;

    private function __construct()
    {
        \add_action('admin_menu', [$this, 'ftlpc_widget_menu']);
        \add_action('plugins_loaded', [$this, 'ftlpc_load_textdomain']);
        $this->ftlpc_includes();
        \register_activation_hook(FTLPC_APP_MAIN_FILE_PATH, [$this, 'ftlpc_activate']);

    }

    public function ftlpc_widget_menu(): void
    {
        $menu_slug = 'first-time-login-password-change';
        \add_menu_page('Password policy', __('Password policy', 'first-time-login-password-change'), 'administrator', $menu_slug, [$this, 'ftlpc'], 'dashicons-lock');
        \add_submenu_page($menu_slug, 'Password policy', __('Settings', 'first-time-login-password-change'), 'administrator', 'ftlpc_settings', [$this, 'ftlpc'], 1);
        \add_submenu_page($menu_slug, 'Password policy', __('Advanced', 'first-time-login-password-change'), 'administrator', 'ftlpc_advanced', [$this, 'ftlpc'], 2);
        \remove_submenu_page($menu_slug, $menu_slug);
    }

    public function ftlpc(): void
    {
        include FTLPC_PLUGIN_PATH . '/controllers' . DIRECTORY_SEPARATOR . 'main_controller.php';
    }

    public function ftlpc_load_textdomain(): void
    {
        \load_plugin_textdomain(FTLPC_APP_TEXT_DOMAIN, false, 'first-time-login-password-change/App/lang/');
    }

    public function ftlpc_includes(): void
    {
        require FTLPC_PLUGIN_PATH . 'helpers' . DIRECTORY_SEPARATOR . 'ftlpc_utility.php';
        require FTLPC_PLUGIN_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ftlpc_ajax_controller.php';
        require FTLPC_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'reset_pass.php';
    }

    public static function ftlpc_activate(): void
    {
        \add_site_option('ftlpc_plugin_active', 'false');
    }
}
