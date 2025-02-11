<?php
namespace Database\Seeders;

use App\Models\Supporter;
use Illuminate\Database\Seeder;

class SupporterSeeder extends Seeder
{
    /**
     * Seed the application's database with sample supporters.
     */
    public function run(): void
    {
        // Generate 50 sample supporters
        Supporter::factory(50)->create();
    }
}
