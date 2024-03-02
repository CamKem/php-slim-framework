<?php

namespace app\Services;

use app\Core\Http\Request;
use app\Core\ServiceProvider;

class RequestService extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(Request::class, fn() => new Request());
    }

    public function boot(): callable
    {
        return function () {
            $this->app->resolve(Request::class);
        };
       // $uri = parse_url($_SERVER['REQUEST_URI'])['path'] ?? '/';
        //$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

}