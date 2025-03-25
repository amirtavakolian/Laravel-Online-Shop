<?php

namespace App\Providers;

use App\Models\Ticket;
use App\Policies\Ticket\Support\SupportTicketPolicy;
use App\Policies\Ticket\TicketPolicy;
use App\Services\ApiResponse\ApiResponseBuilder;
use Authentication\App\Enum\Authentication;
use Authentication\App\Services\TwoAuth\CallTwoAuth;
use Authentication\App\Services\TwoAuth\EmailTwoAuth;
use Authentication\App\Services\TwoAuth\SmsTwoAuth;
use Authentication\App\Services\TwoAuth\TwoAuth;
use Coworkers\App\Models\Coworker;
use Coworkers\App\Policies\CoworkersPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use RolePermission\App\Policies\RolePolicy;
use Spatie\Permission\Models\Role;

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

        $this->app->bind(TwoAuth::class, function ($application, $params) {
            return match ($params[0]) {
                Authentication::SEND_TWO_AUTH_BY_EMAIL->value => new EmailTwoAuth(),
                Authentication::SEND_TWO_AUTH_BY_SMS->value => new SmsTwoAuth(),
                Authentication::SEND_TWO_AUTH_BY_CALL->value => new CallTwoAuth(),
            };
        });

        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Coworker::class, CoworkersPolicy::class);
        Gate::policy(Ticket::class, TicketPolicy::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
