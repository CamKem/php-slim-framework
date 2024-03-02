<?php

namespace App\Core\Routing;

use Closure;

class Router
{
    protected RouteCollection $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    public function add(Route $route): Route
    {
        return $this->routes->add($route);
    }

    // TODO: make a more robust router that returns instances of a Route object
    //  that way we can add properties to the route, like name, middleware, etc
    //  must also implement a way to call the route from the Route object
    public function route($uri, $method): mixed
    {
        foreach ($this->routes as $route) {

            if ($route->getUri() === $uri && $route->getMethod() === strtoupper($method)) {

                $controller = $route->getController();
                $action = $route->getAction();

                // If the controller is a closure, then we can just call it
                // Todo: fix the Route object to allow for a closure to be passed as a controller
                if ($controller instanceof Closure) {
                    return $controller();
                }

                // if $action is null, then we can call the invoke method on the controller
                if ($action === null) {
                    return (new $controller())();
                }

                if (is_string($controller) && $action !== null) {
                    return (new $controller)->$action();
                }

            }

        }

        $this->abort();
    }

    public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }

    /**
     * Load the Routes into the RouterColllection in the Router
     */
    public function loadRoutes(): void
    {
        require base_path('routes/web.php');
    }

    protected function abort($code = 404): void
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
