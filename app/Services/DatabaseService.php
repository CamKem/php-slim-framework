<?php

namespace app\Services;

use app\Core\Database;
use app\Core\ServiceProvider;
use app\Database\Migrator;

class DatabaseService extends ServiceProvider
{

    public function register()
    {
        $this->container->singleton(Database::class, fn() =>
            new Database(config('database'))
        );

        $this->container->singleton(Migrator::class, fn() =>
            new Migrator()
        );
    }

}