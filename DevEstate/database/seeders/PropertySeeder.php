<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $properties = [
            [
                'name' => 'Aster Lane Bungalow',
                'slug' => 'aster-lane-bungalow',
                'badge' => 'Featured',
                'property_type' => 'Bungalow',
                'location' => 'North Grove, Cagayan de Oro',
                'description' => 'Clean single-storey layout with a wide driveway, landscaped frontage, and an open living area suited for first-time buyers.',
                'price' => 2850000,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'floor_area' => 52,
                'lot_area' => 110,
                'parking_spaces' => 1,
                'image_path' => 'images/properties/house1.jpg',
            ],
            [
                'name' => 'Casa Verde Corner Home',
                'slug' => 'casa-verde-corner-home',
                'badge' => 'New',
                'property_type' => 'Single Detached',
                'location' => 'Greenfields Residences, Bukidnon',
                'description' => 'Modern corner home with extra windows, bright interior potential, and a compact footprint that still feels spacious.',
                'price' => 3480000,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'floor_area' => 68,
                'lot_area' => 96,
                'parking_spaces' => 1,
                'image_path' => 'images/properties/house2.jpg',
            ],
            [
                'name' => 'Solstice Townhouse',
                'slug' => 'solstice-townhouse',
                'badge' => 'Top Rated',
                'property_type' => 'Townhouse',
                'location' => 'Central Homes, Davao City',
                'description' => 'Two-level townhouse with balcony frontage, efficient room planning, and a low-maintenance layout for city living.',
                'price' => 3720000,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'floor_area' => 74,
                'lot_area' => 80,
                'parking_spaces' => 1,
                'image_path' => 'images/properties/house3.jpg',
            ],
            [
                'name' => 'Horizon Crest Residence',
                'slug' => 'horizon-crest-residence',
                'badge' => 'Available',
                'property_type' => 'Two-Storey House',
                'location' => 'Sunview Estates, Cebu',
                'description' => 'Family-sized two-storey home with flexible upstairs rooms, generous facade, and room for future outdoor improvements.',
                'price' => 5180000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'floor_area' => 108,
                'lot_area' => 132,
                'parking_spaces' => 2,
                'image_path' => 'images/properties/house4.jpg',
            ],
            [
                'name' => 'Veranda Prime House',
                'slug' => 'veranda-prime-house',
                'badge' => 'Premium',
                'property_type' => 'Single Detached',
                'location' => 'Maple Heights, General Santos',
                'description' => 'Contemporary family home with tall windows, balanced facade, and multiple private rooms for growing households.',
                'price' => 5640000,
                'bedrooms' => 4,
                'bathrooms' => 3,
                'floor_area' => 120,
                'lot_area' => 145,
                'parking_spaces' => 2,
                'image_path' => 'images/properties/house5.jpg',
            ],
        ];

        foreach ($properties as $property) {
            Property::updateOrCreate(
                ['slug' => $property['slug']],
                $property
            );
        }
    }
}
