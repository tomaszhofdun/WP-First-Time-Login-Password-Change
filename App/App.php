<?php

declare(strict_types=1);

namespace FTLPC;

use FTLPC\Services\ActionsLoader;
use FTLPC\Services\FilterLoader;

if (!defined('ABSPATH')) {
    exit;
}

final class App
{
    use Singleton;

    private function __construct()
    {
        $this->loadServices();
    }

    private function loadServices(): void
    {
        ActionsLoader::instance();
        FilterLoader::instance();
    }
}
