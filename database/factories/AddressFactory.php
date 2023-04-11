<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'address_line_1' => fake()->address,
            'address_line_2' => fake()->optional()->address,
            'zip_code' => fake()->numberBetween($min = 4, $max = 6),
            'city' => fake()->city,
            'state' => fake()->state,
            'type' => fake()->randomElement(['home', 'office']),

        ];
    }
}
