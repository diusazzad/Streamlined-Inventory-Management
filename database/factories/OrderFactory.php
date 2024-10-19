<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customers' => Customer::factory(), // Create a customer if it doesn't exist
            'order_date' => $this->faker->dateTimeThisYear()->format('Y-m-d'), // Random order date
            'order_status' => $this->faker->randomElement([0, 1]), // 0 for Pending, 1 for Complete
            'total_products' => $this->faker->numberBetween(1, 10), // Random number of products
            'sub_total' => $this->faker->numberBetween(100, 1000), // Random subtotal
            'vat' => $this->faker->numberBetween(5, 50), // Random VAT amount
            'total' => function (array $attributes) {
                return $attributes['sub_total'] + $attributes['vat']; // Total = Subtotal + VAT
            },
            'invoice_no' => $this->faker->unique()->numerify('INV#####'), // Unique invoice number
            'payment_type' => $this->faker->randomElement(['cash', 'credit_card', 'bank_transfer']), // Payment types
            'pay' => $this->faker->numberBetween(100, 1000), // Amount paid
            'due' => function (array $attributes) {
                return max(0, $attributes['total'] - $attributes['pay']); // Due = Total - Pay (ensure non-negative)
            },
        ];
    }
}
