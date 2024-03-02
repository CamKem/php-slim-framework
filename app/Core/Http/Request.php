<?php

namespace App\Core\Http;

use App\Core\Routing\Route;
use App\Core\Routing\Router;

class Request
{
    protected string $method;
    protected string $uri;
    protected array $headers;
    protected array $body;
    protected array $parameters;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->headers = getallheaders();
        $this->body = $_POST;
        $this->parameters = $_REQUEST;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return parse_url($this->uri, PHP_URL_PATH);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function getParameter(string $key, $default = null)
    {
        return $this->parameters[$key] ?? $default;
    }

    public function input(string $key, $default = null)
    {
        return $this->parameters[$key] ?? $default;
    }

    public function route($parameter = null): Route
    {
        $route = $this->resolveRoute();

        if ($parameter !== null) {
            return $route->getParameter($parameter);
        }

        return $route;
    }

    public function resolveRoute(): Route
    {
        return app(Router::class)->getRoutes()->match($this);
    }

}