<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function checkPageRouter($uri): void
    {
        // if the URI is a view file, require it
        if (file_exists(base_path("views/{$uri}.view.php"))) {
            require view($uri, ['heading' => ucfirst(ltrim($uri, '/'))]);
            //die();
        }
    }

    public function add($method, $uri, $controller): array
    {
        return $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'name' => '',
        ];
    }

    // TODO: make a more robust router that returns instances of a Route object
    //  that way we can add properties to the route, like name, middleware, etc
    //  must also implement a way to call the route from the Route object
    public function name($name): void
    {
        $routes[count($this->routes) - 1]['name'] = $name;
    }

    public function get($uri, $controller): array
    {
        return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller): array
    {
        return $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller): array
    {
        return $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller): array
    {
        return $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller): array
    {
        return $this->add('PUT', $uri, $controller);
    }

    public function route($uri, $method): mixed
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                // change it to look for an array, containing the [controller, method]
                if (is_array($route['controller'])) {
                    $controller = new $route['controller'][0];
                    $method = $route['controller'][1];
                    return $controller->$method();
                }
                if (is_string($route['controller'])) {
                    // handle single action controllers
                    if (str_contains($route['controller'], '\\')) {
                        $controller = new $route['controller'];
                        return $controller();
                    }
                }
            }
        }

        $this->checkPageRouter($uri);

        $this->abort();
    }

    protected function abort($code = 404): void
    {
        http_response_code($code);

        require base_path("views/{$code}.php");

        die();
    }
}
