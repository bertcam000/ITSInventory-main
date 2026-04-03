<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Asset;
use App\Models\Department;
use App\Models\MonitorSpec;
use App\Models\SystemUnitSpec;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $assets = Asset::factory(40)->create();

        foreach ($assets as $asset) {
            if ($asset->asset_type === 'monitor') {
                MonitorSpec::factory()->create([
                    'asset_id' => $asset->id,
                ]);
            }

            if ($asset->asset_type === 'system_unit') {
                SystemUnitSpec::factory()->create([
                    'asset_id' => $asset->id,
                ]);
            }
        }

        // Department::factory(4)->create();
        // User::factory()->create([
        //     'name' => 'Admin User',
        //     'username' => 'admin',
        //     'role' => 'admin'
        // ]);
    }
}
