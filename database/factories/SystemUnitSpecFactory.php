<?php

namespace Database\Factories;

use App\Models\Asset;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SystemUnitSpec>
 */
class SystemUnitSpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'processor' => fake()->randomElement(['Intel Core i5', 'Intel Core i7', 'AMD Ryzen 5', 'AMD Ryzen 7']),
            'memory' => fake()->randomElement(['8GB', '16GB', '32GB']),
            'storage' => fake()->randomElement(['256GB SSD', '512GB SSD', '1TB HDD']),
            'videocard' => fake()->randomElement(['NVIDIA GTX 1660', 'NVIDIA RTX 3060']),
        ];
    }
}
