<?php

namespace Coworkers\App\Http\Requests;

use App\Rules\Ticket\IsTicketClosedRule;
use App\Rules\Ticket\IsTicketOpenedRule;
use App\Rules\Ticket\TicketBelongsToDepartmentRule;
use Illuminate\Foundation\Http\FormRequest;

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
