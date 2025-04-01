<?php

namespace Products\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware(['api', 'auth:coworkers'])
            ->prefix('api/panel/')
            ->group(__DIR__ . '/../../routes/product_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    public function boot()
    {

    }
}
