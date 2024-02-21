<?php

namespace app\Services;

use app\Core\Router;
use app\Core\ServiceProvider;

class RouterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(Router::class, fn() => new Router());
    }

}