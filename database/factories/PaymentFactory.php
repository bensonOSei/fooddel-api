<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'paid', 'failed']);
        if($status === 'paid') {
            $transactionStatus = 'success';
        } elseif ($status === 'failed') {
            $transactionStatus = 'failed';
        } else {
            $transactionStatus = 'pending';
        }

        return [
            'order_id' => Order::factory(),
            'amount' => $this->faker->randomFloat(2, 0, 100),
            'status' => $status,
            'payment_method' => $this->faker->randomElement(['card', 'mobile_money']),
            'transaction_id' => $this->faker->uuid(),
            'transaction_reference' => $this->faker->uuid(),
            'transaction_status' => $status,
        ];
    }
}
