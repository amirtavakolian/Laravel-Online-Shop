<?php

namespace RolePermission\App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use RolePermission\App\Http\Requests\StoreRolesRequest;
use Spatie\Permission\Models\Role;

class RoleExist implements ValidationRule
{
    public function __construct(private StoreRolesRequest $request)
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $roleExistResult = Role::query()->where([
            'name' => $value,
            'guard_name' => $this->request->input('guard_name')
        ])->exists();

        if ($roleExistResult) {
            $fail('validation.unique')->translate();
        }
    }
}
