<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mediaable_id' => $this->factoryForModel($this->modelName()),
            'mediaable_type' => $this->model,
            'path' => $this->faker->imageUrl,
        ];
    }
}
