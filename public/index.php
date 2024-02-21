<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

const BASE_PATH = __DIR__.'/../';

// functions are autoloaded in composer.json
require BASE_PATH . 'vendor/autoload.php';
//require BASE_PATH . 'functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

require base_path('bootstrap/bootstrap.php');


