<?php

namespace Database\Seeders;

use App\Models\BankForm;
use Illuminate\Database\Seeder;

class BankFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method creates sample Bank Form records using the factory.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 sample BankForm records
        BankForm::factory()->count(10)->create();
    }
}
