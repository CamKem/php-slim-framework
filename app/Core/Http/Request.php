<?php

namespace App\Core\Http;

use App\Core\Routing\Route;
use App\Core\Routing\Router;

class Request
{
    protected string $method;
    protected string $uri;
    protected array $headers;
    protected array $bodyParameters;
    protected array $queryParameters;
    protected string $sessionId;

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->uri = $this->stripQueryString($_SERVER['REQUEST_URI']);
        $this->headers = getallheaders();
        $this->bodyParameters = $_POST;
        $this->queryParameters = $_GET;
        $this->sessionId = $_REQUEST['PHPSESSID'] ?? null;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setMethod(string $method): void
    {
        $this->method = $method;
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

    public function getParameters(): array
    {
        return array_merge($this->queryParameters, $this->bodyParameters);
    }

    public function has(string $key): bool
    {
        return isset($this->getParameters()[$key]);
    }

    public function get(string $key, $default = null)
    {
        return $this->getParameters()[$key] ?? $default;
    }

    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    public function stripQueryString(string $uri): string
    {
        if (str_contains($uri, '?')) {
            return explode('?', $uri)[0];
        }

        return $uri;
    }

    public function route($parameter = null): Route
    {
        $route = app(Router::class)->getRoutes()->match($this);

        if ($parameter !== null) {
            return $route->getParameter($parameter);
        }

        return $route;
    }

}