<?php

namespace Authentication\App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginWithPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "mobile" => 'required',
            'password' => 'required|min:5'
        ];
    }
}
