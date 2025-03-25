<?php

namespace Database\Seeders;

use Coworkers\App\Models\SupportDepartment;
use Illuminate\Database\Seeder;

class SupportDepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!SupportDepartment::query()->exists()) {
            SupportDepartment::query()->insert([
                ['name' => 'فنی'],
                ['name' => 'مالی و حسابداری'],
                ['name' => 'بازاریابی'],
                ['name' => 'پیشنهادات و انتقادات'],
            ]);
        }
    }
}

