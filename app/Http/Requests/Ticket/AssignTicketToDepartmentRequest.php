<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class AssignTicketToDepartmentRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'support_department_id' => 'required|exists:support_departments,id',
            'ticket_id' => 'required|exists:tickets,id',
            'assign_reason' => 'required|min:5'
        ];
    }
}
