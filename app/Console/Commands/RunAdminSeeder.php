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
        $phoneNumber = $this->ask("Phone number: ");

        $firstName = $this->ask("First name: ");

        $lastName = $this->ask("Last name: ");

        $password = $this->ask("Password: ");

        if (!is_numeric($phoneNumber)) {
            echo "Phone number must be a number";
            return;
        }

        $this->info("Running admin seeder");

        $seeder->run($phoneNumber, $firstName, $lastName, $password);

        $this->info('Seeder completed successfully.');
    }
}
