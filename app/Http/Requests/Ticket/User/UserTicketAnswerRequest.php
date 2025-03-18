<?php

namespace App\Http\Requests\Ticket\User;

use Illuminate\Foundation\Http\FormRequest;

class UserTicketAnswerRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'content' => 'required|string',
        ];
    }
}
