<?php

namespace Categories\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class CategoriesServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware(['api', 'auth:coworkers'])
            ->prefix('api/panel/')
            ->group(__DIR__ . '/../../routes/category_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    public function boot()
    {

    }
}
