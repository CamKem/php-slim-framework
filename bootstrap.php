<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('config', function () {
    require base_path('config.php');
    return loadConfig();
});

$container->bind('Core\Database', fn() =>
    new Database($container->resolve('config')['database'])
);

App::setContainer($container);
