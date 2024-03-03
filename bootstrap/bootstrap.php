<?php

use App\Core\App;
use App\Core\Http\Request;
use App\Core\Routing\Router;
use App\Services\ConfigService;
use App\Services\DatabaseService;
use App\Services\EnvService;
use App\Services\RequestService;
use App\Services\RouterService;

// Create the application & container.
$app = new App();

// Register service providers in the correct order
$app->registerProvider(new EnvService($app));
$app->registerProvider(new ConfigService($app));
$app->registerProvider(new DatabaseService($app));
$app->registerProvider(new RouterService($app));
$app->registerProvider(new RequestService($app));

// Boot the Application
$app->boot();

// Route the request
try {
    // Get the request from the container, bound in the service
    $request = $app->resolve(Request::class);
    // Get the router from the container, bound in the service
    $router = $app->resolve(Router::class);
    // Route the request
    $router->route($request);
} catch (Exception $e) {
    die($e->getMessage());
}