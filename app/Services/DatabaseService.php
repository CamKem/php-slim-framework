<?php

namespace App\Services;

use App\Core\Database;
use App\Core\ServiceProvider;
use App\Database\Migrator;
use Override;

class DatabaseService extends ServiceProvider
{

    #[Override]
    public function register(): void
    {
        $this->app->singleton('db',Database::class);

        $this->app->singleton('migrate',Migrator::class);
    }

    #[Override]
    public function boot(): callable
    {
        return fn() => $this->app->resolve(Database::class)->connect();
        // TODO: if the route name is 'migrate' then run the migration
//        if (request()->route()->getName() === 'migrate') {
//            return $this->app->resolve(Migrator::class)->run();
//        }
    }

}