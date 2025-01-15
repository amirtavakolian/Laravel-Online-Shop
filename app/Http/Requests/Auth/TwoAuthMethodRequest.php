<?php

namespace App\Http\Requests\Auth;

use App\Enum\Authentication;
use Illuminate\Foundation\Http\FormRequest;

class TwoAuthMethodRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'twoauth_method' => "required|in:email,call,sms"
        ];
    }
}
