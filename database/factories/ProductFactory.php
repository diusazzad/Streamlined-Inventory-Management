<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'code' => $this->faker->unique()->word,
            // Uncomment if needed
            //$table->string('product_barcode_symbology')->nullable();
            'quantity' => $this->faker->numberBetween(1, 100),
            'buying_price' => $this->faker->numberBetween(100, 1000),
            'selling_price' => $this->faker->numberBetween(200, 1500),
            'quantity_alert' => $this->faker->numberBetween(1, 10),
            'tax' => $this->faker->optional()->numberBetween(0, 20),
            'tax_type' => $this->faker->optional()->randomElement([0, 1]), // Assuming 0 for inclusive and 1 for exclusive
            'notes' => $this->faker->optional()->sentence,
            'product_image' => $this->faker->optional()->imageUrl(640, 480, 'products'),
            'category_id' => Category::factory(), // Create a category if it doesn't exist
            'units' => Unit::factory(), // Create a unit if it doesn't exist
        ];
    }
}
