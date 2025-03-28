<?php

namespace Attributes\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AttributesServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/attribute_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    public function boot()
    {

    }
}
