<?php

namespace app\Core\Routing;

use app\Core\Collecting\Collection;
use app\Core\Exceptions\HttpMethodNotAllowedException;
use app\Core\Exceptions\HttpNotFoundException;
use app\Core\Http\Request;

class RouteCollection
{
    /**
     * Array of routes keyed by name.
     */
    protected Collection $routes;

    public function __construct()
    {
        $this->routes = new Collection();
    }

    /**
     * Add the given route to the arrays of routes.
     *
     * @param Route $route
     * @return Route
     */
    public function add(Route $route): Route
    {
        $this->routes->put($route->getName(), $route);

        return $route;
    }

    /**
     * Find the first route matching a given request.
     *
     * @param Request $request
     * @return Route
     * @var Route $route
     * @throws HttpMethodNotAllowedException
     * @throws HttpNotFoundException
     */
    public function match(Request $request): Route
    {
        // first we need to get the request method
        $method = $request->getMethod();
        // then we need to get the uri from the request
        $uri = $request->getUri();
        dd($this->routes);
        // then we need to loop through the routes to find the matching route
        $this->routes->each(function ($route) use ($method, $uri) {
            // if the route matches the request method and path
            dd($route);
            if ($route->matches($method, $uri)) {
                // then we return the route
                return $route;
            }
        });
        return $this->routes->get($request->getPath())
            ?? throw new HttpNotFoundException();
    }

    /**
     * Determine if the route collection contains a given named route.
     * @param string $name
     * @return bool
     */
    public function hasRoute(string $name): bool
    {
        return $this->routes->has($name);
    }

    /**
     * Get a route instance by its name
     *
     * @param string $name
     * @return Route|null
     */
    public function getRoute(string $name): Route|null
    {
        return $this->routes->get($name);
    }

    /**
     * Get all the routes that are defined.
     * @return Route[]
     */
    public function getRoutes(): array
    {
        return $this->routes->toArray();
    }

    public function getRouteByMethod(): Route {}

    /**
     * Get all the routes keyed by their HTTP verb.
     * @return Collection
     */
    public function getRoutesByMethod(): Collection
    {
        // loop through the routes and change the Collection to use the method as the key
        return $this->routes->each(function (Route $route) {
            // sort the routes by their method
            // then return the routes
        });
    }

    public function getRouteByAction(): Route {}

    /**
     * Get all the route keyed by their controller action.
     *
     * @return Collection
     */
    public function getRoutesByAction(): Collection
    {
        // loop through the routes and change the Collection to use the action as the key
        return $this->routes->each(function (Route $route) {
            // sort the routes by their action
            // then return the routes
        });
    }
}