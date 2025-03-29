<?php

namespace Tickets\App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tickets\App\Models\Ticket;
use Tickets\App\Policies\TicketPolicy;

class TicketsServiceProvider extends ServiceProvider
{

    public function register()
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../../routes/ticket_routes.php');

        $this->loadMigrationsFrom(__DIR__ . '/../../Database/Migrations');

        $this->loadFactoriesFrom(__DIR__ . '/../../Database/Factories');

        Gate::policy(Ticket::class, TicketPolicy::class);

    }

    public function boot()
    {

    }
}
