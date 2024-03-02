<?php

namespace app\Core\Routing;

use app\Core\Arrayable;
use app\Core\Controller;
use app\Core\Exceptions\RouteException;
use Closure;

/**
 * Methods that can be chained onto a route definition.
 *
 * @method controller(string|Arrayable|Controller|Callable $controller)
 * @method middleware(string $middleware)
 * @method name(string $name)
 * @method where(array $where)
 */

class RouteRegistrar
{

    protected static Router $router;

    /**
     * The attributes that can be applied to a route definition.
     * Through this class, by chaining methods onto a definition,
     * you can set these attributes.
     *
     * @var array
     */
    protected array $attributes = [
        'name',
        'controller',
        'middleware',
        'where',
    ];

    public function __construct(Router|null $router = null)
    {
        self::$router = $router ?? new Router();
    }

    public function attribute(string $key, mixed $value): static
    {
        if (!in_array($key, $this->attributes, true)) {
            throw new RouteException("Attribute [{$key}] does not exist.");
        }

        if ($key === 'middleware') {
            foreach ($value as $index => $middleware) {
                $value[$index] = (string) $middleware;
            }
        }

        $this->attributes[$key] = $value;
        return $this;
    }

    /**
     * Create a route group with shared attributes.
     *
     * @param Closure $callback
     * @return $this
     */
    public function group(Closure $callback)
    {
        $this->router->group($this->attributes, $callback);

        return $this;
    }

    /**
     * Register a new route with the router.
     *
     * @return void
     */
    public function __call($method, $parameters)
    {
        $this->attributes[$method] = $parameters[0];
        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

}