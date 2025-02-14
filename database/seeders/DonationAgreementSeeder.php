<?php

namespace Database\Seeders;

use App\Models\DonationAgreement;
use Illuminate\Database\Seeder;

class DonationAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * This method creates sample Donation Agreement records.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 sample donation agreements
        DonationAgreement::factory()->count(10)->create();
    }
}
