<?php

namespace Database\Factories;

use App\Models\BankForm;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankFormFactory extends Factory
{
    // Specify the model that this factory is for.
    protected $model = BankForm::class;

    /**
     * Define the model's default state.
     *
     * This method returns an array of attributes with fake data for testing.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bank_name' => $this->faker->company, // Generates a fake company name
            'form_name' => $this->faker->words(2, true), // Generates a fake two-word form name
            // Generates a fake file path for the form. Adjust the path if needed.
            'form_file' => 'forms/' . $this->faker->slug . '.pdf',
        ];
    }
}
