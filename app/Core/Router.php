<?php

namespace app\Core;

class Router
{
    protected array $routes = [];

    public function add(Route $route): Route
    {
        return $this->routes[] = $route;
    }

    // TODO: make a more robust router that returns instances of a Route object
    //  that way we can add properties to the route, like name, middleware, etc
    //  must also implement a way to call the route from the Route object
    public function route($uri, $method): mixed
    {
        foreach ($this->routes as $route) {

            if ($route->getUri() === $uri && $route->getMethod() === strtoupper($method)) {
                // If the controller is an array, then the second element is the action method
                if (is_array($route->getController())) {
                    $controller = $route->getController();
                    $controller = new $controller[0];
                    $action = $route->getController()[1];
                    return $controller->$action();
                }

                // If the controller is a string, then it's a single action controller that should be invoked
                if (is_string($route->getController())) {
                    $controllerInstance = $route->getController();
                    // invoke the controller like a function
                    return (new $controllerInstance())();
                }
            }

        }

        $this->checkPageRouter($uri);

        $this->abort();
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function checkPageRouter($uri): void
    {
        // if the URI is a view file, require it
        if (file_exists(base_path("views/{$uri}.view.php"))) {
            require view($uri, ['heading' => ucfirst(ltrim($uri, '/'))]);
            //die();
        }
    }

    protected function abort($code = 404): void
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
