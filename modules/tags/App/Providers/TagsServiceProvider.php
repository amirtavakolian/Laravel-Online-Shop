<?php

namespace Tags\App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class TagsServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware(['api', 'auth:coworkers'])
            ->prefix('/api/panel')
            ->group(__DIR__ . '/../../routes/tag_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');
    }

    public function boot()
    {

    }
}
