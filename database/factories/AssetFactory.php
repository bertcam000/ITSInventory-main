<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Asset>
 */
class AssetFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $assetType = fake()->randomElement(['system_unit', 'monitor']);
        return [
            'user_id' => 1,
            'serial_number' => fake()->unique()->numerify('########'),
            'asset_type' => $assetType,
            'brand' => $assetType === 'monitor' ? 'Dell' : 'HP',
            'model' => $assetType === 'monitor' ? 'E201' : 'OptiPlex 5030',
            'status' => 'available',
            'created_by' => 1,
        ];
    }

}
