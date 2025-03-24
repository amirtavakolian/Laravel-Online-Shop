<?php

namespace RolePermission\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use RolePermission\App\Rules\PermissionExist;

class StorePermissionsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $guards = array_keys(config('auth.guards'));

        $this->merge([
            "guard_name" => $this->input('coworkers_guard') ? $guards[2] : $guards[1]
        ]);

        return [
            "permissions" => "required|array",
            "permissions.*" => ["string", "min:4",new PermissionExist($this)],
            "coworkers_guard" => "required|in:0,1"
        ];
    }
}
