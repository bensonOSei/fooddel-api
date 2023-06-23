<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\MenuItems;
use App\Models\Payment;
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
            'menu_item_id' => MenuItems::factory(),
            'total' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
