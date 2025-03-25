<?php

namespace Tickets\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tickets\App\Enum\TicketStatus;

class StoreTicketRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'support_department_id' => 'required|exists:support_departments,id',
            'priority' => 'required|in:' . implode(',', [
                    TicketStatus::URGENT->value,
                    TicketStatus::IMPORTANT->value,
                    TicketStatus::NORMAL->value,
                ]),
        ];
    }
}


















