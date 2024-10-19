<?php

namespace Database\Factories;

use App\Models\purchase;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\purchase>
 */
class PurchaseFactory extends Factory
{
    protected $model = purchase::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'suppliers' => Supplier::factory(), // Create a supplier if it doesn't exist
            'date' => $this->faker->date(), // Random purchase date
            'purchase_no' => $this->faker->unique()->numerify('PUR#####'), // Unique purchase number
            'status' => $this->faker->randomElement([0, 1]), // 0 for Pending, 1 for Approved
            'total_amount' => $this->faker->numberBetween(1000, 10000), // Random total amount
            'users' => User::factory(), // Create a user if it doesn't exist
        ];
    }
}
