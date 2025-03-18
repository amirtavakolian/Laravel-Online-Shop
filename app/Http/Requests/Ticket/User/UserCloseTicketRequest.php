<?php

namespace App\Http\Requests\Ticket\User;

use Illuminate\Foundation\Http\FormRequest;

class UserCloseTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'satisfaction_rate' => 'required|integer|in:1,2,3,4,5'
        ];
    }
}
