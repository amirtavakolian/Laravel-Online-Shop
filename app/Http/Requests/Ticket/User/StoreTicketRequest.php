<?php

namespace App\Http\Requests\Ticket\User;

use App\Enum\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;

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


















