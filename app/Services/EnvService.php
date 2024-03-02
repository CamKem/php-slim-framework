<?php

namespace app\Services;

use app\Core\Env;
use app\Core\ServiceProvider;
use Override;

class EnvService extends ServiceProvider
{
    #[Override]
    public function register(): void
    {
        $this->app->singleton(Env::class);
    }

    #[Override]
    public function boot(): callable
    {
        return function () {
            /** @var Env $env */
            $env = $this->app->resolve(Env::class);
            //$env->load();
        };
    }

}