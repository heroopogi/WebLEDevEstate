<?php

namespace Database\Seeders;

use App\Models\Listing;
use Illuminate\Database\Seeder;

class ListingSeeder extends Seeder
{
    public function run(): void
    {
        Listing::query()->insert([
            [
                'name' => 'Azure Bay Terrace',
                'location' => 'Makati City',
                'property_type' => 'Condominium',
                'bedrooms' => 3,
                'bathrooms' => 2,
                'price' => 920000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Skyline Ridge Residence',
                'location' => 'Cebu IT Park',
                'property_type' => 'Townhouse',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'price' => 780000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Harbor Crest Penthouse',
                'location' => 'Bonifacio Global City',
                'property_type' => 'Penthouse',
                'bedrooms' => 3,
                'bathrooms' => 3,
                'price' => 1150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
