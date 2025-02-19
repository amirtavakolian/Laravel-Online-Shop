<?php

namespace App\Rules\RolePermission;

use App\Http\Requests\RolePermission\StorePermissionsRequest;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Spatie\Permission\Models\Permission;

class PermissionExist implements ValidationRule
{
    public function __construct(private StorePermissionsRequest $request)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $roleExistResult = Permission::query()->where([
            'name' => $value,
            'guard_name' => $this->request->input('guard_name')
        ])->exists();

        if ($roleExistResult) {
            $fail('validation.unique')->translate();
        }
    }
}
