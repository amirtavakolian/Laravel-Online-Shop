<?php

namespace Brands\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BrandsServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/brand_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    public function boot()
    {

    }
}
