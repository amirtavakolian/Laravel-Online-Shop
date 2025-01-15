<?php

namespace App\Providers;

use App\Enum\Authentication;
use App\Services\ApiResponse\ApiResponseBuilder;
use App\Services\Authentication\TwoAuth\CallTwoAuth;
use App\Services\Authentication\TwoAuth\EmailTwoAuth;
use App\Services\Authentication\TwoAuth\SmsTwoAuth;
use App\Services\Authentication\TwoAuth\TwoAuth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('ApiResponseFacade', function () {
            return new ApiResponseBuilder();
        });

        $this->app->bind(TwoAuth::class, function ($application, $params){
            return match ($params[0]){
                Authentication::SEND_TWO_AUTH_BY_EMAIL->value => new EmailTwoAuth(),
                Authentication::SEND_TWO_AUTH_BY_SMS->value => new SmsTwoAuth(),
                Authentication::SEND_TWO_AUTH_BY_CALL->value => new CallTwoAuth(),
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
