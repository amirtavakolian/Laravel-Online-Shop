<?php

namespace Tickets\App\Rules;

use Closure;
use Coworkers\App\Models\Coworker;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Tickets\App\Models\Ticket;

class TicketBelongsToDepartmentRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $coworkerDepartments = Coworker::find(auth()->guard('coworkers')->user()->id);

        $ticket = Ticket::find($value);

        if (!in_array($ticket->support_department_id, $coworkerDepartments->supportDepartments->pluck('id')->toArray())) {
            $fail('تیک مطعلق به دپارتمان دیگری میباشد.');
        }
    }
}
