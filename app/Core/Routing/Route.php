<?php

namespace app\Core\Routing;

use app\Core\Controller;
use Closure;
use Exception;
use app\Core\Exceptions\RouteException;
use RuntimeException;

/**
 * Class Route
 * @method static RouteRegistrar get(string $uri)
 * @method static RouteRegistrar post(string $uri)
 * @method static RouteRegistrar put(string $uri)
 * @method static RouteRegistrar patch(string $uri)
 * @method static RouteRegistrar delete(string $uri)
 */

class Route
{
    protected string $uri;
    // TODO: make the controlller type hint a Controller class
    protected string|Controller|Closure $controller;
    protected string|null $action;
    protected array $middleware;
    protected string $method;

    protected string $name;

    /**
     * @throws Exception
     */
    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;

//        // Add the new route to the Router
//        $this->register();
    }

    // register the route at the end of the method chains on a static route definition
    public function __destruct()
    {
        $this->register();
    }

    public function register(): self
    {
        if (empty($this->name)) {
            throw new RouteException('All routes must use name()');
        }
        if (empty($this->controller)) {
            throw new RouteException('All routes must use controller()');
        }
        app(Router::class)->add($this);
        return $this;
    }

    public static function get(string $uri): RouteRegistrar
    {
        return new RouteRegistrar(app(Router::class), 'GET', $uri);
    }

    public static function post(string $uri): RouteRegistrar
    {
        return new RouteRegistrar('POST', $uri);
    }

    public static function put(string $uri): RouteRegistrar
    {
        return new RouteRegistrar('PUT', $uri);
    }

    public static function patch(string $uri): RouteRegistrar
    {
        return new RouteRegistrar('PATCH', $uri);
    }

    public static function delete(string $uri): RouteRegistrar
    {
        return new RouteRegistrar('DELETE', $uri);
    }

    public function middleware(array $middleware): self
    {
        $this->middleware = $middleware;
        return $this;
    }

    public function name($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function controller(string|array|Closure $controller): self
    {
        if (is_string($controller) && !is_subclass_of($controller, Controller::class)) {
            throw new RuntimeException('Controller must be a subclass of Controller');
        }

        // if its a closure, store it as the controller
        if ($controller instanceof Closure) {
            $this->controller = $controller;
            return $this;
        }

        if (is_array($controller)) {
            if (!is_subclass_of($controller[0], Controller::class)) {
                throw new RuntimeException('Controller must be a subclass of Controller');
            }
            $this->action = $controller[1] ?? null;
            $controller = $controller[0];
        }

        if (!$controller instanceof Controller) {
            throw new RuntimeException('Controller must be an instance of Controller or a string representing a subclass of Controller');
        }

        $this->controller = $controller;
        return $this;
    }

    public function matches(string $method, string $uri): bool
    {
        return $this->getMethod() === $method && $this->getUri() === $uri;
    }

    // Add getters for uri, controller, method, and name

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getUrl(): string
    {
        return config('app.url') . $this->uri;
    }

    public function getController(): string|array|Controller
    {
        return $this->controller;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getName(): string
    {
        return $this->name;
    }

}