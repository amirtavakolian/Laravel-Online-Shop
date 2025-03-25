<?php

namespace Tickets\App\Services\OpenTicketChain;

use Tickets\App\Models\Ticket;

abstract class TicketHandler
{

    protected $nextHandler;

    public function __construct(TicketHandler $nextHandler = null)
    {
        $this->nextHandler = $nextHandler;
    }

    public function handle(Ticket $ticket)
    {
        if (!$this->nextHandler) {
            return true;
        }

        return $this->nextHandler->handle($ticket);
    }
}
