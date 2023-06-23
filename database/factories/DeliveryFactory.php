<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'order_id' => Order::factory(),
            'delivery_city' => $this->faker->city(),
            'delivery_town' => $this->faker->name(),
            'delivery_street' => $this->faker->streetAddress(),
            'delivery_region' => $this->faker->state(),
            'delivery_fee' => $this->faker->randomFloat(2, 0, 10),
            'delivery_time' => $this->faker->dateTimeBetween("-2 years"), // from 2 years ago to now
            'delivery_status' => $this->faker->randomElements(['pending','cancelled','success'])
        ];
    }
}
