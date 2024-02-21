<?php

namespace app\Services;

use app\Core\Database;
use app\Core\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->container->bind(Database::class, fn() =>
            new Database($this->container->resolve('config')['database'])
        );
    }

}