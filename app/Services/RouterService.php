<?php

namespace app\Services;

use app\Core\Routing\RouteCollection;
use app\Core\Routing\Router;
use app\Core\ServiceProvider;
use Override;

class RouterService extends ServiceProvider
{

    #[Override]
    public function register(): void
    {
        $this->app->bind(RouteCollection::class, static fn() => new RouteCollection());
        $this->app->bind(Router::class, static fn() => new Router());
    }

    #[Override]
    public function boot(): callable
    {
        return fn() => $this->app->resolve(Router::class)->loadRoutes();
        // TODO: autocomplete doesn't work here, not sure why
        //   because we are injecting the App container into the base ServiceProvider
        //   whereas below the app() helper works fine.
        //   autocomplete works here with the app() helper
        //   app(Router::class)->loadRoutes();
        /** @var Router $router */
//        $router = $this->app->resolve(Router::class);
//        $router->loadRoutes();
       //dd($this->app->resolve(Router::class)->getRoutes());
    }

}