<?php

namespace App\Services\Ticket;

use App\Events\Ticket\NewTicketReceived;
use App\Models\Ticket;

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

    public function all()
    {
        return Ticket::query()->whereIn('support_department_id',
            auth()->guard('coworkers')->user()->supportDepartments->pluck('id')->toArray())
            ->whereNull('closed_at')->get();
    }
}
