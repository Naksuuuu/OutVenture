<?php

namespace Database\Factories;

use App\Models\User;
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
            // 'total_harga' => fake()->randomFloat(2, 10, 1000),
            // 'status_pembayaran' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            // 'id_user' => User::factory(),
            // 'tgl_order' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
