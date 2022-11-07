<?php

declare(strict_types=1);

$controller = FTLPC_PLUGIN_PATH . 'controllers' . DIRECTORY_SEPARATOR;

if (\current_user_can('administrator') && isset($_GET['page'])) {
    $page = \sanitize_text_field($_GET['page']);

    include $controller . 'navbar_controller.php';
    echo ' <br> <table class="" style="width:100%;"><tr><td class="" style="width:74%;">';

    switch ($page) {
        case 'ftlpc_settings':
            include $controller . 'ftlpc_settings.php';
            break;
        case 'ftlpc_advanced':
            include $controller . 'ftlpc_advanced.php';
            break;
    }
}
