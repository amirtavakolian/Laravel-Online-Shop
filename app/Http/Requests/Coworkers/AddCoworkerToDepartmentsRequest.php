<?php

namespace App\Http\Requests\Coworkers;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class AddCoworkerToDepartmentsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "coworker_id" => "required|exists:coworkers,id",
            "support_department_id" => "required|array",
            "support_department_id.*" => "exists:support_departments,id",
        ];
    }
}
