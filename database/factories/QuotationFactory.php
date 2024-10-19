<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Quotation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Quotation>
 */
class QuotationFactory extends Factory
{
    protected $model = Quotation::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subTotal = $this->faker->numberBetween(1000, 5000); // Random subtotal
        $taxPercentage = $this->faker->numberBetween(0, 20); // Random tax percentage
        $discountPercentage = $this->faker->numberBetween(0, 20); // Random discount percentage

        // Calculate tax amount and discount amount
        $taxAmount = ($subTotal * $taxPercentage) / 100;
        $discountAmount = ($subTotal * $discountPercentage) / 100;
        return [
            'date' => $this->faker->date(),
            'reference' => $this->faker->unique()->numerify('QT#####'), // Unique quotation reference
            'customers' => Customer::factory(), // Create a customer if it doesn't exist
            'customer_name' => $this->faker->name, // Random customer name
            'tax_percentage' => $taxPercentage,
            'tax_amount' => $taxAmount,
            'discount_percentage' => $discountPercentage,
            'discount_amount' => $discountAmount,
            'shipping_amount' => $this->faker->numberBetween(0, 500), // Random shipping amount
            'total_amount' => $subTotal + $taxAmount - $discountAmount, // Total amount calculation
            'status' => $this->faker->randomElement([0, 1]), // Example statuses (0 for Pending, 1 for Approved)
            'note' => $this->faker->optional()->text, // Optional note
        ];
    }
}
