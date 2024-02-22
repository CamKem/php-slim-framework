<?php

namespace app\Services;

use app\Core\ServiceProvider;

class ConfigService extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton('config', function () {
            require_once base_path('bootstrap/config.php');
            return loadConfig();
        });
    }
}