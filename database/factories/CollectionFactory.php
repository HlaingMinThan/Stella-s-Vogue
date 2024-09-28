<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            [
                'fabric' => fake()->numberBetween(1, 100),
                'under' => fake()->numberBetween(1, 100),
                'sample_pattern' => fake()->numberBetween(1, 100),
                'sew_fees' => fake()->numberBetween(100, 1000),
                'model_fees' => fake()->numberBetween(100, 1000),
                'model_deli_fees' => fake()->numberBetween(100, 500),
                'boosting' => fake()->numberBetween(100, 500),
                'phone_bill' => fake()->numberBetween(50, 300),
                'packing_fees' => fake()->numberBetween(50, 300),
                'extra_charges' => fake()->numberBetween(50, 500),
                'taxi_charges' => fake()->numberBetween(50, 300),
                'ga__vlog_charges' => fake()->numberBetween(50, 300),
                'stock' => fake()->numberBetween(1, 500),
            ]
        ];
    }
}
