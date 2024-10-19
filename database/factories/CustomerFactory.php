<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    protected $model = Customer::class;
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
            'type' => $this->faker->randomElement(['retail', 'wholesale']),
            'photo' => $this->faker->imageUrl(640, 480, 'people'), // Generates a random image URL
            'account_holder' => $this->faker->name,
            'account_number' => $this->faker->bankAccountNumber,
            'bank_name' => $this->faker->company . " Bank",
        ];
    }
}
