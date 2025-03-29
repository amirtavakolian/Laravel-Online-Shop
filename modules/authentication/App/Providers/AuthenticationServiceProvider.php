<?php

namespace Authentication\App\Providers;

use Authentication\App\Enum\Authentication;
use Authentication\App\Services\TwoAuth\CallTwoAuth;
use Authentication\App\Services\TwoAuth\EmailTwoAuth;
use Authentication\App\Services\TwoAuth\SmsTwoAuth;
use Authentication\App\Services\TwoAuth\TwoAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/auth_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');

        $this->loadFactoriesFrom(__DIR__ . '/../../Database/Factories');

        $this->loadViewsFrom(__DIR__ . '/../../Resources/views', 'Authentication');

        $this->app->bind(TwoAuth::class, function ($application, $params) {
            return match ($params[0]) {
                Authentication::SEND_TWO_AUTH_BY_EMAIL->value => new EmailTwoAuth(),
                Authentication::SEND_TWO_AUTH_BY_SMS->value => new SmsTwoAuth(),
                Authentication::SEND_TWO_AUTH_BY_CALL->value => new CallTwoAuth(),
            };
        });

    }

    public function boot()
    {

    }
}
