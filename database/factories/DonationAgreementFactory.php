<?php

namespace Database\Factories;

use App\Models\BankForm;
use App\Models\DonationAgreement;
use App\Models\Supporter;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationAgreementFactory extends Factory
{
    protected $model = DonationAgreement::class;

    /**
     * Define the model's default state.
     *
     * This generates fake data for a Donation Agreement.
     *
     * @return array
     */
    public function definition()
    {
        // Randomly choose donation type
        $donationType = $this->faker->randomElement(['one-time', 'recurring']);

        return [
            // Associate with an existing supporter; if none exist, a new one is created.
            'supporter_id' => Supporter::factory(),
            // Associate with an existing bank form; if none exist, a new one is created.
            'bank_id' => BankForm::factory(),
            'donation_type' => $donationType,
            'donation_amount' => $this->faker->randomFloat(2, 10, 1000),
            // For recurring donations, set an interval; otherwise, keep it null.
            'recurring_interval' => $donationType === 'recurring' ? $this->faker->randomElement(['monthly', 'yearly']) : null,
            // Simulate a file path for the signed agreement PDF.
            'signed_agreement_pdf' => 'agreements/' . $this->faker->slug . '.pdf',
        ];
    }
}
