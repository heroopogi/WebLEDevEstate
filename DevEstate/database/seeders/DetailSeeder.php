<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    public function run(): void
    {
        Detail::query()->create([
            'property_name' => 'Azure Bay Terrace',
            'location' => 'Makati City',
            'description' => 'An elegant urban home with curated finishes, smart controls, and private amenity access.',
            'bedrooms' => 3,
            'bathrooms' => 2,
            'area_sqft' => 1840,
            'price' => 920000,
        ]);
    }
}
