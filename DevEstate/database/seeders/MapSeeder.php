<?php

namespace Database\Seeders;

use App\Models\Map;
use Illuminate\Database\Seeder;

class MapSeeder extends Seeder
{
    public function run(): void
    {
        Map::query()->insert([
            [
                'place_name' => 'Financial District',
                'description' => 'Corporate offices and business lounges.',
                'distance_minutes' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_name' => 'Harbor Retail Row',
                'description' => 'Dining, shopping, and lifestyle brands.',
                'distance_minutes' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'place_name' => 'St. Helena Academy',
                'description' => 'Top-rated academic district.',
                'distance_minutes' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
