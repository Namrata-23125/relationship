<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'address' => fake()->unique()->address(),
        'number' => fake()->phoneNumber(), // Adjust the range as needed
        'city' => fake()->city(),
        'zip_code' =>fake()->unique()->postcode()
    ];
    }
}
