<?php

namespace App\Http\Requests\Auth\Coworkers;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCoworkersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'birthday_date' => 'required',
            'mobile' => ['required','regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/','unique:coworkers,mobile'],
            'marriage_status' => 'required|in:1,0',
            'children_count' => 'required|integer',
            'gender' => 'required|in:man,woman',
            'emergency_number' => ['required','regex:/((0?9)|(\+?989))\d{2}\W?\d{3}\W?\d{4}/'],
            'position' => 'required'
        ];
    }
}










