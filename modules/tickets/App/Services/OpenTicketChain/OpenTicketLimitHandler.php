<?php

namespace Tickets\App\Services\OpenTicketChain;

use Exception;
use Tickets\App\Models\Ticket;

class OpenTicketLimitHandler extends TicketHandler
{

    public function handle(Ticket $ticket)
    {
        if (is_null($ticket->opened_by)) {

            $coworkerOpenedTicketsCount = Ticket::query()
                ->where('opened_by', auth()->guard('coworkers')->user()->id)
                ->count();

            if ($coworkerOpenedTicketsCount >= 3) {
                throw new Exception('شما 3 تیکت باز دارید که فعلا بسته نشده اند');
            }

        }

        return parent::handle($ticket);
    }
}
