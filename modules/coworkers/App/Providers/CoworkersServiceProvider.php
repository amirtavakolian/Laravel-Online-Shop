<?php

namespace Coworkers\App\Providers;

use Coworkers\App\Models\Coworker;
use Coworkers\App\Policies\CoworkersPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CoworkersServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/coworkers_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');

        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');

        Gate::policy(Coworker::class, CoworkersPolicy::class);
    }

    public function boot()
    {

    }
}
