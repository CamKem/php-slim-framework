<?php

use app\Core\App;
use app\Core\Container;
use app\Core\Router;
use app\Services\ConfigServiceProvider;
use app\Services\DatabaseServiceProvider;
use app\Services\RouterServiceProvider;

$container = new Container();

// Set the container in the src class
App::setContainer($container);

// Register service providers
(new ConfigServiceProvider($container))->register();
(new DatabaseServiceProvider($container))->register();
(new RouterServiceProvider($container))->register();

// bind each route to the container
require base_path('routes.php');

// Get the router from the container
$router = $container->resolve(Router::class);

// Handle the current request
$uri = parse_url($_SERVER['REQUEST_URI'])['path'] ?? '/';
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);