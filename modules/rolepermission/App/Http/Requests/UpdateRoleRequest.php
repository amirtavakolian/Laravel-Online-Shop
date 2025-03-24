<?php

namespace RolePermission\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            "role" => "required|string|min:4"
        ];
    }
}
