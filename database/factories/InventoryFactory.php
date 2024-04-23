<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "name" => fake()->name(),
            "price" => fake()->numberBetween($min=10000, $max=50000),
            "point" => fake()->numberBetween($min=10, $max=50),
            "stock" => fake()->numberBetween($min=50, $max=250),
            "discount" => fake()->numberBetween($min=0, $max=25),
        ];
    }
}
