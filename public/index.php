<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//require __DIR__.'/../vendor/autoload.php';

const BASE_PATH = __DIR__.'/../';

include BASE_PATH . 'bootstrap/functions.php';

spl_autoload_register(static function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require BASE_PATH . "{$class}.php";
});

require base_path('bootstrap/bootstrap.php');


// TODO:  thi is a todo that we can track in the todo list