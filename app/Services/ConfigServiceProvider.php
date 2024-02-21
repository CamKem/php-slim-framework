<?php

namespace app\Services;

class ConfigServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->bind('config', function () {
            require base_path('config.php');
            return loadConfig();
        });
    }
}