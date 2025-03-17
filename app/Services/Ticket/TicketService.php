<?php

namespace App\Services\Ticket;

use App\Enum\TicketStatus;
use App\Events\Ticket\NewTicketReceived;
use App\Models\Ticket;
use App\Models\TicketAnswer;
use App\Models\User;
use App\Notifications\Ticket\TicketAnsweredNotification;
use App\Services\Ticket\OpenTicketChain\OpenedByAssignmentHandler;
use App\Services\Ticket\OpenTicketChain\OpenTicketLimitHandler;
use App\Services\Ticket\OpenTicketChain\TicketOwnershipValidationHandler;
use Exception;

class TicketService
{

    public function store(array $request)
    {
        if ($this->userTicketHistoryCheck(auth()->user()->id, $request['support_department_id'])) {
            return 'ye ticket baz az ghabl dari';
        }

        $newTicket = Ticket::query()->create($request);

        NewTicketReceived::dispatch($newTicket);
    }

    public function userTicketHistoryCheck($userId, $departmentId)
    {
        return Ticket::query()
            ->where('user_id', $userId)
            ->where('support_department_id', $departmentId)
            ->whereNotNull('closed_at')
            ->exists();
    }

    public function open(Ticket $ticket)
    {
        try {
            $c = new OpenedByAssignmentHandler();
            $b = new OpenTicketLimitHandler($c);
            $a = new TicketOwnershipValidationHandler($b);

            $a->handle($ticket);
            return true;

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function supportCoworkerAnswer($request)
    {
        TicketAnswer::query()->create($request->all());

        $ticket = Ticket::find($request->input('ticket_id'));

        $ticket->update(['status' => TicketStatus::RESPONDED->value]);

        User::find($ticket->user_id)->notify(new TicketAnsweredNotification());
    }

    public function all()
    {
        return Ticket::query()->whereIn('support_department_id',
            auth()->guard('coworkers')->user()->supportDepartments->pluck('id')->toArray())
            ->whereNull('closed_at')->get();
    }
}
