<?php

declare(strict_types=1);
$logo_url = \plugin_dir_url(\dirname(__FILE__)) . 'assets/images/ftlpc.png';
$active_tab = \sanitize_text_field($_GET['page']);
$settings_url = \add_query_arg(['page' => 'ftlpc_settings'], $_SERVER['REQUEST_URI']);
$advanced_url = \add_query_arg(['page' => 'ftlpc_advanced'], $_SERVER['REQUEST_URI']);
$test_url = \add_query_arg(['page' => 'ftlpc_test'], $_SERVER['REQUEST_URI']);
include FTLPC_PLUGIN_PATH . 'views' . DIRECTORY_SEPARATOR . 'navbar.php';
