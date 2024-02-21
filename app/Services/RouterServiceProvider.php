<?php

namespace app\Services;

use app\Core\Router;

class RouterServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->container->singleton(Router::class, fn() => new Router());
    }

}