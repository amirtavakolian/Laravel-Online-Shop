<?php

namespace App\Console\Commands;

use Database\Seeders\AdminSetupSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RunAdminSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run-admin-seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(AdminSetupSeeder $seeder)
    {
        $phoneNumber = $this->ask("Phone number");
        $firstName = $this->ask("First name");
        $lastName = $this->ask("Last name");
        $password = $this->ask("Password");
        $marriageStatus = $this->ask("Marriage status");
        $birthdayDate = "1993-05-29 14:30:00";
        $gender = 'man';
        $emergencyNumber = $this->ask("Emergency number");
        $position = 'مدیر';

        $this->info("Running admin seeder");

        $seeder->run($phoneNumber, $firstName, $lastName, $password, $marriageStatus, $birthdayDate,
            $gender, $emergencyNumber, $position);

        $this->info('Seeder completed successfully.');
    }
}
