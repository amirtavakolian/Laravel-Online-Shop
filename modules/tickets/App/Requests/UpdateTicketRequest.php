<?php

namespace Tickets\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tickets\App\Enum\TicketStatus;

class UpdateTicketRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:5',
            'content' => 'required|string|min:5',
            'priority' => 'required|in:' . implode(',', [
                    TicketStatus::URGENT->value,
                    TicketStatus::IMPORTANT->value,
                    TicketStatus::NORMAL->value,
                ]),
        ];
    }
}


