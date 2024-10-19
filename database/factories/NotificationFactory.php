<?php

namespace Database\Factories;

use App\Models\Notification;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    protected $model = Notification::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(), // Generate a UUID for the notification
            'type' => $this->faker->word, // Random type of notification
            'notifiable_type' => $this->faker->randomElement(['App\Models\User', 'App\Models\Admin']), // Example notifiable types
            'notifiable_id' => $this->faker->randomNumber(), // Random ID for notifiable entity
            'data' => json_encode(['message' => $this->faker->sentence]), // Sample data as JSON
            'read_at' => $this->faker->optional()->dateTime(), // Random read timestamp or null
        ];
    }
}
