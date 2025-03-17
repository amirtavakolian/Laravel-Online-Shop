<?php

namespace App\Services\Ticket\OpenTicketChain;

use App\Models\Ticket;
use Exception;

class TicketOwnershipValidationHandler extends TicketHandler
{
    public function handle(Ticket $ticket)
    {
        $coworkerDepartment = auth()->guard('coworkers')->user()->supportDepartments
            ->pluck('id')->toArray();

        if (!in_array($ticket->support_department_id, $coworkerDepartment)) {
            throw new Exception('تیکت انتخاب شده مطعلق به دپارتمان دیگری میباشد');
        }

        return parent::handle($ticket);
    }
}
