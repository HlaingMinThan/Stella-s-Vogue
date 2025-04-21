<?php

namespace Database\Factories;

use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReturnList>
 */
class ReturnListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ids = Collection::pluck('id');
        return [
            'customer_name' => $this->faker->name(),
            'collection_id' => fake()->randomElement($ids),
            'color' => $this->faker->colorName(),
            'note' => $this->faker->optional()->sentence(),
            'date' => now()
        ];
    }
}
