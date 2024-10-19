<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Quotation;
use App\Models\QuotationDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuotationDetail>
 */
class QuotationDetailFactory extends Factory
{
    protected $model = QuotationDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 10); // Random quantity
        $price = $this->faker->numberBetween(100, 500); // Random price
        $productDiscountAmount = $this->faker->numberBetween(0, 50); // Random discount amount
        $productTaxAmount = ($price * 0.1); // Example tax calculation (10% of price)
        return [
            'quotations' => Quotation::factory(), // Create a quotation if it doesn't exist
            'products' => Product::factory(), // Create a product if it doesn't exist
            'product_name' => $this->faker->word, // Random product name
            'product_code' => $this->faker->unique()->numerify('PROD#####'), // Unique product code
            'quantity' => $quantity,
            'price' => $price,
            'unit_price' => $price, // Assuming unit price is the same as price here
            'sub_total' => ($quantity * $price) - $productDiscountAmount, // Subtotal calculation
            'product_discount_amount' => $productDiscountAmount,
            'product_discount_type' => $this->faker->randomElement(['fixed', 'percentage']), // Discount type
            'product_tax_amount' => $productTaxAmount,
        ];
    }
}
