<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SetPasswordForMobileRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'password' => 'required|min:5|confirmed',
            'otp' => 'required|numeric|max_digits:4'
        ];
    }
}
