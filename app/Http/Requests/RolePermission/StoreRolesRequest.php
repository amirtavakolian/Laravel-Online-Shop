<?php

namespace App\Http\Requests\RolePermission;

use App\Rules\RolePermission\RoleExist;
use Illuminate\Foundation\Http\FormRequest;

class StoreRolesRequest extends FormRequest
{
    public function rules(): array
    {
        $guards = array_keys(config('auth.guards'));

        $this->merge([
            "guard_name" => $this->input('coworkers_guard') ? $guards[2] : $guards[1]
        ]);

        return [
            "roles" => "required|array",
            "roles.*" => ["string", "min:4", new RoleExist($this)],
            "coworkers_guard" => "required|in:0,1"
        ];
    }
}


