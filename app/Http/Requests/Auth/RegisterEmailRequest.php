<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterEmailRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "email" => ['required', "unique:users,email"],
            "password" => ["required", "min:6", "confirmed"]
        ];
    }
}
