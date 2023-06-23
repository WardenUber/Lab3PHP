<?php

namespace Database\Factories;

use App\Models\Dealership;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->text(20),
            'model' => $this->faker->unique()->text(10),
            'brand' => $this->faker->unique()->text(10),
            'power' => $this->faker->numberBetween(80, 800),
            'volume' => $this->faker->numberBetween(1, 7),
            'dealerships_id' => Dealership::factory(),
        ];
    }
}
