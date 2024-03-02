<?php

namespace App\Core;

abstract class ServiceProvider
{
    protected App $app;
//    protected array $bootCallbacks = [];

    public function __construct(App $app)
    {
        /** @var App $app */
        $this->app = $app;
    }

    abstract public function register();

    abstract public function boot(): callable;

}