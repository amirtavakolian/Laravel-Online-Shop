<?php

namespace Database\Seeders;

use App\Models\SupportDepartment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Predis\Command\Traits\DB;

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

