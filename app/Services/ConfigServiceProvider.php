<?php

namespace app\Services;

use app\Core\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->bind('config', function () {
            require base_path('bootstrap/config.php');
            return loadConfig();
        });
    }
}