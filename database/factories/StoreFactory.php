<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'name' => $this->faker->company(),
            'type' => $this->faker->randomElement(['restaurant', 'cafe', 'supermarket', 'pharmacy']),
            'license_number' => $this->faker->bothify('??-####-###'),
            'commercial_register' => $this->faker->uuid(),
        ];
    }
}
