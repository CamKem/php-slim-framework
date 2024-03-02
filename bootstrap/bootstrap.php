<?php

use app\Core\App;
use app\Core\Http\Request;
use app\Core\Routing\Router;
use app\Services\ConfigService;
use app\Services\DatabaseService;
use app\Services\EnvService;
use app\Services\RequestService;
use app\Services\RouterService;

// Create the application & container.
$app = new App();

// Register service providers
$app->registerProvider(new EnvService($app));
$app->registerProvider(new ConfigService($app));
$app->registerProvider(new DatabaseService($app));
$app->registerProvider(new RequestService($app));
$app->registerProvider(new RouterService($app));

//// use a glob pattern to register all service providers
//foreach (glob(base_path('app/Services/*.php')) as $provider) {
//    $provider = 'app\\Services\\' . basename($provider, '.php');
//    $app->registerProvider(new $provider($app));
//}

// Boot the Application
$app->boot();

//dd($app->debugInfo());

try {
    // Get the request from the container, bound in the service
    $request = $app->resolve(Request::class);
    $uri = $request->getUri();
    $method = $request->getMethod();

    // Get the router from the container, bound in the service
    $router = $app->resolve(Router::class);
    // Route the request
    $router->route($uri, $method);
} catch (Exception $e) {
    die($e->getMessage());
}