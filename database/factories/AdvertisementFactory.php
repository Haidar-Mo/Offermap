<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advertisement>
 */
class AdvertisementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $startDate = $this->faker->dateTimeBetween('now', '+1 month');
        $endDate = $this->faker->dateTimeBetween($startDate, '+3 months');

        return [
            'branch_id' => \App\Models\Branch::factory(),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount_ratio' => $this->faker->randomFloat(2, 0, 50),
            'status' => $this->faker->randomElement(['active', 'pending', 'expired']),
        ];
    }

    public function active()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'active',
                'start_date' => now()->subDays(1),
                'end_date' => now()->addDays(30),
            ];
        });
    }

    public function expired()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'expired',
                'start_date' => now()->subDays(60),
                'end_date' => now()->subDays(30),
            ];
        });
    }
}
