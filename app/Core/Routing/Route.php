<?php

namespace App\Core\Routing;

use Closure;

class Route
{
    protected string $uri;
    protected string|Closure $controller;
    protected string|null $action;
    protected array $middleware = [];
    protected string $method;

    protected string $name;

    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function matches(string $method, string $uri): bool
    {
        return $this->method === $method && $this->uri === $uri;
    }

    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    public function setMiddleware(array $middleware): void
    {
        foreach ($middleware as $m) {
            $this->middleware[] = $m;
        }
    }

    public function getAction(): string|null
    {
        return $this->action ?? null;
    }

    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    public function getController(): string|Closure
    {
        return $this->controller;
    }

    public function setController(string|array|Closure $controller): void
    {
        // if it's a string, we assume that it's a class name
        if (is_string($controller)) {
            $this->controller = $controller;
        }

        // if it's a closure, we assume that it's an anonymous function
        if ($controller instanceof Closure) {
            $this->controller = $controller;
        }

        // if an array, we need to split the class and method names
        if (is_array($controller)) {
            $this->controller = $controller[0];
            $this->setAction($controller[1]);
        }

    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function generate(array $params = []): string
    {
        $uri = $this->getUri();

        if (!empty($params)) {
            $queryString = http_build_query($params);
            $uri = "{$uri}?{$queryString}";
        }

        return $uri;
    }

}