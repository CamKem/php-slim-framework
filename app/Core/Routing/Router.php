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

    // TODO: add the ability to constrain the route parameters
    public function route(Request $request): mixed
    {
        //dd($request);
        // Check for a _method field in the POST data
        if ($request->getMethod() === 'POST' && $request->has('_method')) {
            // Validate the _method field
            $method = strtoupper($request->get('_method'));
            if (in_array($method, ['PUT', 'PATCH', 'DELETE'])) {
                // Use the _method field as the HTTP method
                $request->setMethod($method);
            }
        }

        $route = $this->getRoutes()->match($request);

        if ($route === null) {
            return $this->abort();
        }

        $this->applyMiddleware($request, $route);

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

    protected function applyMiddleware(Request $request, Route $route): void
    {
        foreach ($route->getMiddleware() as $alias) {
            if (app()->hasAlias($alias)) {
                $middleware = app()->getAlias($alias);
                (new $middleware())->handle($request);
            }
        }
    }

    public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }

    // generate a URL for the given named route
    public function generate(string $name, array $params = []): string
    {
        $route = $this->routes->getRoute($name);
        if ($route) {
            return $route->generate($params);
        }
        return $this->abort();
    }

    /**
     * Load the Routes into the RouteCollection in the Router
     */
    public function loadRoutes(): void
    {
        require base_path('routes/web.php');
    }

    /**
     * Abort the request & Return the error page
     * @param int $code
     * @return null
     */
    protected function abort(int $code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
}
