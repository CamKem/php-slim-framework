<?php

use Core\App;
use Core\Response;
use const public\BASE_PATH;

function dd($value): void
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value): bool
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404): void
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
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
    return App::getContainer()->resolve('config')[$key];
}

function redirect($path): void
{
    header("Location: {$path}");
    exit();
}

// TODO: implement a way to allow the extraction of any namespace (nested directories) from the controller
//     and the method from the URI
function view($path, $attributes = []): string
{
    extract($attributes);

    return require base_path('views/' . str_replace('.', '/', $path) . '.view.php');
}