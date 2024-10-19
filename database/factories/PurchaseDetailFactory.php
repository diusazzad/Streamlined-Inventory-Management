<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\purchase;
use App\Models\PurchaseDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchaseDetail>
 */
class PurchaseDetailFactory extends Factory
{
    protected $model = PurchaseDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 10); // Random quantity
        $unitCost = $this->faker->numberBetween(100, 500); // Random unit cost
        return [
            'purchases' => purchase::factory(), // Create a purchase if it doesn't exist
            'products' => Product::factory(), // Create a product if it doesn't exist
            'quantity' => $quantity,
            'unitcost' => $unitCost,
            'total' => $quantity * $unitCost, // Total = Quantity * Unit Cost
        ];
    }
}
