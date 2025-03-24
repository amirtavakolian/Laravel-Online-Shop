<?php

namespace Authentication\Http\Request;

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
