<?php

namespace Tickets\App\Listeners;

use Tickets\App\Events\NewTicketReceived;
use Tickets\App\Jobs\NewTicketReceivedBossReminderJob;
use Tickets\App\Jobs\NewTicketReceivedReminderJob;

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
