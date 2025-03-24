<?php

namespace Authentication\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../routes/auth_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadFactoriesFrom(__DIR__ . '/../Database/Factories');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'Authentication');
    }

    public function boot()
    {

    }
}
