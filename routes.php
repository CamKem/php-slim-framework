<?php

use Controllers\Notes\NotesController;
use Core\Router;

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/About.php');
$router->get('/contact', 'controllers/Contact.php');

$router->get('/notes', [NotesController::class, 'index']);
$router->get('/note', [NotesController::class, 'show']);
$router->delete('/note', [NotesController::class, 'destroy']);
$router->get('/notes/create', [NotesController::class, 'create']);
$router->post('/notes', [NotesController::class, 'store']);

// TODO: make the calls static, so that the router is a singleton.
// so we don't have multiple instances of the router.
// maybe we should make a Route class that stores the routes in a static array.
// but each route is an instance of the Route class.
// then the Router class can have a static method to get the routes.
//Router::get('/notes', [NotesController::class, 'index']);

