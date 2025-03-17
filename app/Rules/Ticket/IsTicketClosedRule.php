<?php

namespace App\Rules\Ticket;

use App\Models\Ticket;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class IsTicketClosedRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!is_null(Ticket::find($value)->closed_at)) {
            $fail('تیکت مورد نظر بسته شده.');
        }
    }
}
