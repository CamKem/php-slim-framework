<?php

use app\Core\App;
use app\Core\Container;
use app\Core\Router;
use app\Services\ConfigServiceProvider;
use app\Services\DatabaseServiceProvider;
use app\Services\RouterServiceProvider;
use app\Services\EnvService;

$container = new Container();

// Set the container in the src class
App::setContainer($container);

// Register service providers
//(new ConfigServiceProvider($container))->register();
//(new DatabaseServiceProvider($container))->register();
//(new RouterServiceProvider($container))->register();
$app->registerProvider(new EnvService($app));

// use a glob pattern to register all service providers
foreach (glob(base_path('app/Services/*.php')) as $provider) {
    $provider = 'app\\Services\\' . basename($provider, '.php');
    (new $provider($container))->register();
}

// bind each route to the container
require base_path('routes/web.php');

// Get the router from the container
$router = $container->resolve(Router::class);

// Handle the current request
$uri = parse_url($_SERVER['REQUEST_URI'])['path'] ?? '/';
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

// Route the request
$router->route($uri, $method);