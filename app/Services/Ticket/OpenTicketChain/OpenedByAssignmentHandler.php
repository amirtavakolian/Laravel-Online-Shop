<?php

namespace App\Services\Ticket\OpenTicketChain;

use App\Enum\TicketStatus;
use App\Models\Ticket;

class OpenedByAssignmentHandler extends TicketHandler
{
    public function handle(Ticket $ticket)
    {
        if (is_null($ticket->opened_by)) {
            $ticket->update([
                'opened_by' => auth()->guard('coworkers')->user()->id,
                'status' => TicketStatus::UNDER_REVIEW->value
            ]);
        }

        return parent::handle($ticket);
    }

}
