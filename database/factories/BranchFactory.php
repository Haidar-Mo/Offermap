<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'store_id' => \App\Models\Store::factory(),
            'name' => $this->faker->streetName(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'type' => $this->faker->randomElement(['A', 'B', 'C']),
            'contact_number' => $this->faker->phoneNumber(),
        ];
    }
}
