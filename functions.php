<?php

use app\Core\App;
use app\Core\Response;

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
    return App::container()->resolve('config')[$key];
}

function redirect($path): void
{
    header("Location: {$path}");
    exit();
}

function view($path, $attributes = []): string
{
    // extract the array into variables
    extract($attributes, EXTR_SKIP);

    // replace dots with slashes and append .view.php & require the file
    return require base_path('views/' . str_replace('.', '/', $path) . '.view.php');
}