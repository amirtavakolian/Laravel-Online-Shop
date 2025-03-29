<?php

namespace RolePermission\App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use RolePermission\App\Policies\RolePolicy;
use Spatie\Permission\Models\Role;

class RolePermissionServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/roleperm_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');

        $this->loadFactoriesFrom(__DIR__ . '/../../Database/Factories');

        Gate::policy(Role::class, RolePolicy::class);

    }

    public function boot()
    {

    }
}
