<?php

namespace Authentication\App\Http\Request;

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
