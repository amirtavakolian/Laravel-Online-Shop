<?php

namespace Coworkers\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tickets\App\Rules\IsTicketClosedRule;
use Tickets\App\Rules\IsTicketOpenedRule;
use Tickets\App\Rules\TicketBelongsToDepartmentRule;

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
