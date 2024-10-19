<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    protected $model = Supplier::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'shopname' => $this->faker->company,
            'type' => $this->faker->randomElement(['wholesale', 'retail']),
            'photo' => $this->faker->imageUrl(640, 480, 'business'), // Generates a random image URL
            'account_holder' => $this->faker->name,
            'account_number' => $this->faker->bankAccountNumber,
            'bank_name' => $this->faker->company . " Bank",
        ];
    }
}
