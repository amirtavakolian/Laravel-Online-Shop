<?php

namespace Authentication\App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class OTPLoginRequest extends FormRequest
{
    public function rules(): array
    {
        if ($this->route()->getActionMethod() === "login") {
            return [
                'mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/']
            ];
        }

        if ($this->route()->getActionMethod() === "verify") {
            return [
                'mobile' => ['required', 'regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/'],
                'otp' => 'required|numeric|max_digits:6'
            ];
        }

        return [];
    }
}
