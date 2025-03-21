<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LinkAuthRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "email" => "required|email"
        ];
    }
}
