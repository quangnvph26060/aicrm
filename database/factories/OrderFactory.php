<?php

namespace Database\Factories;

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
            'user_id'=> $this->faker->randomElement(['3', '4']),
            'client_id' => $this->faker->numberBetween(51, 100),
            'total_money' => $this->faker->randomFloat(2, 100000, 10000000),
            'status' => $this->faker->randomElement(['0', '1']), //1 là pending 2 là completed
            'note' => $this->faker->sentence,
            'receive_address' => $this->faker->address,
        ];
    }
}
