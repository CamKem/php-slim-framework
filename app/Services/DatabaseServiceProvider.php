<?php

namespace app\Services;

use app\Core\Database;

class DatabaseServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->container->bind(Database::class, fn() =>
            new Database($this->container->resolve('config')['database'])
        );
    }

}