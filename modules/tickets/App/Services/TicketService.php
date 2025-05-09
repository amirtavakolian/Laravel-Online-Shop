<?php

namespace Tickets\App\Services;

use Authentication\App\Models\User;
use Coworkers\App\Models\AssignTicket;
use Coworkers\App\Models\Coworker;
use Exception;
use RolePermission\Enum\Role;
use Tickets\App\Enum\TicketStatus;
use Tickets\App\Events\NewTicketReceived;
use Tickets\App\Models\Ticket;
use Tickets\App\Models\TicketAnswer;
use Tickets\App\Notifications\AssignTicketNotification;
use Tickets\App\Notifications\AssignTicketToCoworkerAlertNotification;
use Tickets\App\Notifications\AssignTicketToDepartmentNotification;
use Tickets\App\Notifications\TicketAnsweredNotification;
use Tickets\App\Services\OpenTicketChain\OpenedByAssignmentHandler;
use Tickets\App\Services\OpenTicketChain\OpenTicketLimitHandler;
use Tickets\App\Services\OpenTicketChain\TicketOwnershipValidationHandler;

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
        $currentUser = auth()->guard('coworkers')->user();

        $tickets = Ticket::query()->where(function ($q) use ($currentUser) {
            if ($currentUser->hasRole(Role::SUPER_ADMIN->value)) {
                return $q;
            }
            return $q->whereIn('support_department_id',
                $currentUser->supportDepartments->pluck('id')->toArray());
        });

        return $tickets->whereNull('closed_at')->get();
    }

    public function assign($request)
    {
        $fromCoworker = auth()->guard('coworkers')->user();

        $ticketToAssign = Ticket::find($request->input('ticket_id'));

        $toCoworker = Coworker::find($request->input('to_coworker'));

        $result = $this->isTicketOpenedByCurrentUser($ticketToAssign, $fromCoworker, 'you_cant_assign_the_ticket_which_you_dont_open');

        if (is_string($result)) return $result;

        $result = $this->isTicketBelongsToUserDepartment($ticketToAssign, $toCoworker, 'you_cant_assign_the_ticket_to_coworkers_of_other_departments');

        if (is_string($result)) return $result;

        $assigneeOpenTicketsCount = Ticket::query()->where('opened_by', $request->input('to_coworker'))
            ->whereNull('closed_at')->count();

        if ($assigneeOpenTicketsCount >= 3) {
            return __('messages.tickets.selected_coworker_currently_has_three_opened_tickets');
        }

        AssignTicket::query()->create([
            'from_coworker' => $fromCoworker->id,
            'to_coworker' => $toCoworker->id,
            'ticket_id' => $ticketToAssign->id,
            'support_department_id' => $ticketToAssign->support_department_id,
            'assign_reason' => $request->input('assign_reason'),
        ]);

        $ticketToAssign->update(['opened_by' => $toCoworker->id]);

        $admins = Coworker::query()->whereHas('roles', function ($q) {
            $q->where('name', Role::SUPER_ADMIN->value);
        })->get();

        $toCoworker->notify(new AssignTicketNotification($fromCoworker, $ticketToAssign));

        $admins->each(function ($admin) use ($fromCoworker, $toCoworker, $ticketToAssign) {
            $admin->notify(new AssignTicketToCoworkerAlertNotification($fromCoworker, $toCoworker, $ticketToAssign));
        });

        return true;
    }

    private function isTicketOpenedByCurrentUser($ticket, $fromCoworker, $message)
    {
        if (is_null($ticket->opened_by) || $ticket->opened_by != $fromCoworker->id) {
            return __('messages.tickets.' . $message);
        }
    }

    private function isTicketBelongsToUserDepartment($ticket, $fromCoworker, $message)
    {
        if (!in_array($ticket->support_department_id, $fromCoworker->supportDepartments->pluck('id')->toArray())) {
            return __('messages.tickets.' . $message);
        }
    }

    public function assignToDepartment($request)
    {
        $ticket = Ticket::find($request->input('ticket_id'));

        $fromCoworker = auth()->guard('coworkers')->user();

        $result = $this->isTicketBelongsToUserDepartment($ticket, $fromCoworker, 'you_cant_assign_another_department_ticket');

        if (is_string($result)) return $result;

        if ($ticket->support_department_id == $request->input('support_department_id')) {
            return __('messages.tickets.ticket_belongs_to_this_department');
        }

        $result = $this->isTicketOpenedByCurrentUser($ticket, $fromCoworker, 'you_cant_assign_the_ticket_which_you_dont_open');

        if (is_string($result)) return $result;

        $ticket->update([
            'is_opened' => 0,
            'opened_by' => null,
            'support_department_id' => $request->input('support_department_id'),
            'status' => TicketStatus::AWAITING_SUPPORT_RESPONSE->value,
        ]);

        $ticket->ticketAnswers()->delete();

        AssignTicket::query()->create([
            'from_coworker' => $fromCoworker->id,
            'ticket_id' => $ticket->id,
            'support_department_id' => $request->input('support_department_id'),
            'assign_reason' => $request->input('assign_reason')
        ]);

        $admins = Coworker::query()->whereHas('roles', function ($q) {
            $q->where('name', Role::SUPER_ADMIN->value);
        })->get();

        $admins->each(function ($admin) use ($ticket, $fromCoworker) {
            $admin->notify(new AssignTicketToDepartmentNotification($ticket->supportDepartment, $fromCoworker));
        });

        return true;
    }

    public function userAnswer($request, $ticket)
    {
        if (!is_null($ticket->closed_at)) {
            $ticket->update(['closed_at' => null]);
        }

        $ticket->ticketAnswers()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id
        ]);

        $ticket->update(['status' => TicketStatus::AWAITING_SUPPORT_RESPONSE->value]);

        $ticket->supportDepartment->coworkers->each(function ($admin) {
            $admin->notify(new TicketAnsweredNotification());
        });
    }
}
