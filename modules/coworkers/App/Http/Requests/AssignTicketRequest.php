<?php

namespace Coworkers\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssignTicketRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'to_coworker' => 'required|integer|exists:coworkers,id',
            'ticket_id' => 'required|integer|exists:tickets,id',
            'assign_reason' => 'required|string',
        ];
    }
}

