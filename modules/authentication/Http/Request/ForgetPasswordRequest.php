<?php

namespace Authentication\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "email" => "required|email"
        ];
    }
}
