<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Delivery;
use App\Static\PaymentOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            // 'address' => fake()->address,
            // 'phone' => fake()->phoneNumber,
            // 'payment' => fake()->randomElement(PaymentOption::all()), // Adjust if needed
            // 'screenshot' => fake()->imageUrl, // Example for image URL; adjust as needed
            // 'delivery_id' => fake()->randomElement(Delivery::pluck('id')), // Assuming you have delivery IDs 1 to 10
            // 'notes' => fake()->sentence,
        ];
    }
}
