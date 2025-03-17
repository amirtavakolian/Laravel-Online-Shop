<?php

namespace App\Http\Requests\Ticket;

use App\Rules\Ticket\IsTicketClosedRule;
use App\Rules\Ticket\IsTicketOpenedRule;
use App\Rules\Ticket\TicketBelongsToDepartmentRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class SupportCoworkerAnswerTicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ticket_id' => ['required', 'exists:tickets,id', new IsTicketOpenedRule, new IsTicketClosedRule, new TicketBelongsToDepartmentRule],
            'support_coworker_id' => ['required', 'exists:coworkers,id'],
            'content' => ['required', 'min:5']
        ];
    }
}
