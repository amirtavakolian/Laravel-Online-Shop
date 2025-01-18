<?php

namespace App\Http\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;

class StoreRolesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "roles" => "required|array",
            "roles.*" => "string|min:4|unique:roles,name"
        ];
    }
}
