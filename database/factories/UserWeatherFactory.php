<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserWeatherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'country' => $this->faker->country,
            'timezone' => $this->faker->timezone,
            'temperature' => $this->faker->numberBetween(-50, 60),
        ];
    }
}
