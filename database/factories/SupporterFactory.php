<?php
namespace Database\Factories;

use App\Models\Supporter;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupporterFactory extends Factory
{
    /**
     * The name of the model that this factory corresponds to.
     */
    protected $model = Supporter::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'type' => $this->faker->randomElement(Supporter::SUPPORTER_TYPES),
            'phone_number' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'contribution_amount' => $this->faker->randomFloat(2, 50, 5000), // Random amount between 50 and 5000
            'photo_url' => $this->faker->imageUrl(200, 200, 'people'), // Random profile picture
            'testimonial_content' => $this->faker->optional()->sentence(), // Random testimonial text
        ];
    }
}

