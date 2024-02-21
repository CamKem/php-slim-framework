<?php

namespace app\Core;

class Route
{
    protected string $uri;
    // TODO: make the controlller type hint a Controller class
    protected string|array|Controller $controller;
    protected string $method;

    // TODO: test adding a name to the route
    protected string $name;

    public function __construct($method, $uri, $controller)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->controller = $controller;
        $this->name = '';

        // Add the new route to the Router
        App::container()->resolve(Router::class)->add($this);
    }

    public static function get($uri, $controller): self
    {
        return new self('GET', $uri, $controller);
    }

    public static function post($uri, $controller): self
    {
        return new self('POST', $uri, $controller);
    }

    public static function put($uri, $controller): self
    {
        return new self('PUT', $uri, $controller);
    }

    public static function delete($uri, $controller): self
    {
        return new self('DELETE', $uri, $controller);
    }

    public static function patch($uri, $controller): self
    {
        return new self('PATCH', $uri, $controller);
    }

    public static function options($uri, $controller): self
    {
        return new self('OPTIONS', $uri, $controller);
    }

    public static function any($uri, $controller): self
    {
        return new self('ANY', $uri, $controller);
    }

    public function name($name): self
    {
        $this->name = $name;
        return $this;
    }

    // Add getters for uri, controller, method, and name

    public function getUri(): string
    {
        return $this->uri;
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