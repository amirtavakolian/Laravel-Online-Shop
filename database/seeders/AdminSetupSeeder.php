<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(string $phoneNumber, null|string $firstName = "", null|string $lastName = "", string|null $password = ""): void
    {
        $adminUser = User::query()->where('mobile', $phoneNumber)->first();

        if (!$adminUser) {
            $adminUser = User::query()->create([
                'mobile' => $phoneNumber,
                'first_name' => $firstName,
                'last_name' => $lastName,
                'password' => Hash::make($password)
            ]);
        }

        if (!Role::query()->where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }

        $adminUser->assignRole('admin');
    }
}
