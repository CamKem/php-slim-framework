<?php

use App\Core\App;
use App\Core\Collecting\Collection;
use App\Core\Config;
use App\Core\Env;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Core\Routing\Router;
use App\Core\Session;
use App\Core\View;
use JetBrains\PhpStorm\NoReturn;

function dd(...$values): void
{
    foreach ($values as $value) {
        echo "<pre>";
        var_dump($value);
        echo "</pre>";
    }
    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

/**
 * Generate a URL for the given route.
 *
 * @param string $name (The name of the route)
 * @param array $params (optional)
 * @return string
 */
function route(string $name, array $params = []): string
{
    return app(Router::class)->generate($name, $params);
}

#[NoReturn]
function abort($code = 404): void
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function collect(array $items = []): Collection
{
    return new Collection($items);
}

function authorize($condition, $status = Response::FORBIDDEN): true
{
    if (! $condition) {
        abort($status);
    }

    return true;
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function config($key): mixed
{
    return app(Config::class)->get($key);
}

// a function that accepts a callable to define a configuration array, to be used by a service provider for setting up configuration values
function configure(callable $config): callable
{
    return app(Config::class)::storeConfigClosure($config);
}

function env($key, $default = null): string
{
    return app(Env::class)->get($key, $default);
}

function response(): Response
{
    return app(Response::class);
}

function redirect($path = null): Response
{
    if ($path === null) {
        return app(Response::class);
    }
    return app(Response::class)->redirect($path);
}

function session(): Session
{
    return app(Session::class);
}

function request($key = null, $default = null): mixed
{
    if ($key === null) {
        return app(Request::class);
    }
    return app(Request::class)->get($key, $default);
}

// add phpdocs to ignore the debug function
function logger($message, $level = 'info', $context = []): void
{
    error_log("[$level] $message: " . print_r($context, true));
}

//// TODO: add login helpers
//function auth(): mixed
//{
//    if (session()->has('user')) {
//        return session()->get('user');
//    }
//    return Auth::user();
//}

/**
 * Resolve a class from the container, via the App class
 * @param string|null $key
 * @return object
 */
function app(string|null $key = null): object
{
    if ($key === null) {
        return App::getContainer();
    }
    return App::getContainer()->resolve($key);
}

function view($path, $attributes = []): View
{
    return View::render($path, $attributes);
}