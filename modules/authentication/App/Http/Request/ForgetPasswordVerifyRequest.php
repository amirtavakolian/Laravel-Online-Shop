<?php

namespace Authentication\App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordVerifyRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "email" => "required|email",
            "code" => "required|min:6",
            "password" => "required|min:6|confirmed"
        ];
    }
}
