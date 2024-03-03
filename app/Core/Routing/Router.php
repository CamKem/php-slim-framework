<?php

namespace App\Core\Routing;

use App\Core\Http\Request;

class Router
{
    protected RouteCollection $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    public function addRoute(Route $route): Route
    {
        return $this->routes->add($route);
    }

    // TODO: add middleware support & the ability to constrain the route parameters
    public function route(Request $request): mixed
    {
        $route = $this->getRoutes()->match($request);

        if ($route === null) {
            return $this->abort();
        }

        $controller = $route->getController();
        $action = $route->getAction();

        // if $action is null, then we can call the invoke method on the controller
        if ($action === null) {
            return (new $controller())();
        }

        if (is_string($controller) && $action !== null) {
            return (new $controller)->$action();
        }
    }

    public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }

    /**
     * Load the Routes into the RouteCollection in the Router
     */
    public function loadRoutes(): void
    {
        require base_path('routes/web.php');
    }

    protected function abort($code = 404): void
    {
        //http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
