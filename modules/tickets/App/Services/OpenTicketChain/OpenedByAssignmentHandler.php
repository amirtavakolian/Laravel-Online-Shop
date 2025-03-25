<?php

namespace Tickets\App\Services\OpenTicketChain;

use Tickets\App\Enum\TicketStatus;
use Tickets\App\Models\Ticket;

class OpenedByAssignmentHandler extends TicketHandler
{
    public function handle(Ticket $ticket)
    {
        if (is_null($ticket->opened_by)) {
            $ticket->update([
                'opened_by' => auth()->guard('coworkers')->user()->id,
                'status' => TicketStatus::UNDER_REVIEW->value,
                'is_opened' => 1
            ]);
        }

        return parent::handle($ticket);
    }

}
