<?php

namespace App\Listeners\Ticket;

use App\Events\Ticket\NewTicketReceived;
use App\Jobs\Ticket\NewTicketReceivedBossReminderJob;
use App\Jobs\Ticket\NewTicketReceivedReminderJob;

class NewTicketListener
{

    public function __construct()
    {

    }

    public function handle(NewTicketReceived $event): void
    {
        NewTicketReceivedReminderJob::dispatch($event)->delay(now()->addMinutes(15));
        NewTicketReceivedBossReminderJob::dispatch($event)->delay(now()->addMinutes(30));
    }
}
