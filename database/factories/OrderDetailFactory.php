<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'orders' => Order::factory(), // Create an order if it doesn't exist
            'products' => Product::factory(), // Create a product if it doesn't exist
            'quantity' => 1, // Set a static quantity
            'unitcost' => 10, // Set a static unit cost
            'total' => 10, // Total is set to be the same as unit cost for simplicity
        ];
    }
}
