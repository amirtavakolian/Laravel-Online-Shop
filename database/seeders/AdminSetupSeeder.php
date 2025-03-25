<?php

namespace Database\Seeders;

use Coworkers\App\Models\Coworker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(string $phoneNumber, null|string $firstName, null|string $lastName, string|null $password,
                        bool   $marriageStatus, string $birthdayDate, string $gender, string $emergencyNumber, string $position): void
    {
        $admin = Coworker::query()->where('mobile', $phoneNumber)->first();

        if (!$admin) {
            $admin = Coworker::query()->create([
                'mobile' => $phoneNumber,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'password' => Hash::make($password),
                'birthday_date' => $birthdayDate,
                'marriage_status' => $marriageStatus,
                'gender' => $gender,
                'emergency_number' => $emergencyNumber,
                'position' => $position
            ]);
        }

        if (!Role::query()->where('name', 'admin')->exists()) {
            Role::create([
                'name' => \Role::SUPER_ADMIN->value,
                'guard_name' => 'coworkers'
            ]);
        }

        $admin->assignRole('admin');
    }
}
