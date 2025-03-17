<?php

namespace App\Rules\Ticket;

use App\Models\Ticket;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class IsTicketOpenedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $ticket = Ticket::find($value);

        if ($ticket && $ticket->opened_by == null) {
            $fail('تیکت مورد نظر باز نشده است.');
        }
    }
}
