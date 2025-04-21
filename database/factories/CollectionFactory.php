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
            'name' => fake()->word(2),
            'fabric' => fake()->numberBetween(100000, 1000000),
            'under' => fake()->numberBetween(100000, 1000000),
            'sample_pattern' => fake()->numberBetween(100000, 1000000),
            'sew_fees' => fake()->numberBetween(100000, 1000000),
            'model_fees' => fake()->numberBetween(100000, 1000000),
            'model_deli_fees' => fake()->numberBetween(100000, 1000000),
            'boosting' => fake()->numberBetween(100000, 1000000),
            'phone_bill' => fake()->numberBetween(100000, 1000000),
            'packing_fees' => fake()->numberBetween(100000, 1000000),
            'extra_charges' => fake()->numberBetween(100000, 1000000),
            'taxi_charges' => fake()->numberBetween(100000, 1000000),
            'ga__vlog_charges' => fake()->numberBetween(100000, 1000000),
        ];
    }
}
