<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $properties = [
            [
                'slug' => 'skyline-ridge-home',
                'name' => 'Skyline Ridge Home',
                'image' => 'images/house1.jpg',
                'badge' => 'Featured listing',
                'price' => '$780,000',
                'summary' => 'Modern finishes and expansive glass bring light into every room.',
                'description' => 'Skyline Ridge Home blends open-plan living with refined comfort, featuring bright interiors, clean architectural lines, and generous spaces designed for both family life and entertaining.',
                'tags' => ['4 Beds', '3 Baths', 'Private Garage'],
                'details' => [
                    ['label' => 'Floor Area', 'value' => '320 sqm'],
                    ['label' => 'Bedrooms', 'value' => '4 Spacious Rooms'],
                    ['label' => 'Location', 'value' => 'Skyline District'],
                    ['label' => 'Style', 'value' => 'Modern Contemporary'],
                ],
            ],
            [
                'slug' => 'parklane-condo',
                'name' => 'Parklane Condo',
                'image' => 'images/house2.jpg',
                'badge' => 'New listing',
                'price' => '$620,000',
                'summary' => 'Urban living with polished amenities and a bright open plan.',
                'description' => 'Parklane Condo offers a polished city lifestyle with an airy layout, practical storage, and well-finished interiors that feel both efficient and welcoming.',
                'tags' => ['3 Beds', '2 Baths', 'City Access'],
                'details' => [
                    ['label' => 'Floor Area', 'value' => '210 sqm'],
                    ['label' => 'Bedrooms', 'value' => '3 Comfortable Rooms'],
                    ['label' => 'Location', 'value' => 'Parklane Center'],
                    ['label' => 'Style', 'value' => 'Urban Minimalist'],
                ],
            ],
            [
                'slug' => 'harbor-crest-penthouse',
                'name' => 'Harbor Crest Penthouse',
                'image' => 'images/house3.jpg',
                'badge' => 'Top rated',
                'price' => '$1,150,000',
                'summary' => 'Elevated city residence with panoramic vistas and private terrace.',
                'description' => 'Harbor Crest Penthouse delivers premium living above the skyline, pairing expansive entertaining spaces with elegant finishes, privacy, and sweeping views.',
                'tags' => ['5 Beds', '4 Baths', 'Private Terrace'],
                'details' => [
                    ['label' => 'Floor Area', 'value' => '460 sqm'],
                    ['label' => 'Bedrooms', 'value' => '5 Premium Suites'],
                    ['label' => 'Location', 'value' => 'Harbor Crest'],
                    ['label' => 'Style', 'value' => 'Luxury Penthouse'],
                ],
            ],
            [
                'slug' => 'riverbend-villa',
                'name' => 'Riverbend Villa',
                'image' => 'images/house4.jpg',
                'badge' => 'Exclusive',
                'price' => '$950,000',
                'summary' => 'Tranquil riverside living with lush gardens and modern amenities.',
                'description' => 'Riverbend Villa offers the perfect blend of nature and luxury, featuring a private riverfront location, expansive gardens, and thoughtfully designed interiors that maximize comfort and style.',
                'tags' => ['4 Beds', '3 Baths', 'Riverfront'],
                'details' => [
                    ['label' => 'Floor Area', 'value' => '380 sqm'],
                    ['label' => 'Bedrooms', 'value' => '4 Master Suites'],
                    ['label' => 'Location', 'value' => 'Riverbend Estates'],
                    ['label' => 'Style', 'value' => 'Contemporary Garden'],
                ],
            ],
            [
                'slug' => 'mountain-view-cottage',
                'name' => 'Mountain View Cottage',
                'image' => 'images/house5.jpg',
                'badge' => 'Cozy retreat',
                'price' => '$425,000',
                'summary' => 'Charming mountain cottage with breathtaking views and rustic charm.',
                'description' => 'Mountain View Cottage provides an idyllic escape with stunning panoramic mountain vistas, warm rustic interiors, and a peaceful atmosphere perfect for those seeking tranquility away from city life.',
                'tags' => ['3 Beds', '2 Baths', 'Mountain Views'],
                'details' => [
                    ['label' => 'Floor Area', 'value' => '180 sqm'],
                    ['label' => 'Bedrooms', 'value' => '3 Cozy Rooms'],
                    ['label' => 'Location', 'value' => 'Pine Ridge Mountains'],
                    ['label' => 'Style', 'value' => 'Rustic Contemporary'],
                ],
            ],
        ];

        foreach ($properties as $property) {
            \App\Models\Property::updateOrCreate(
                ['slug' => $property['slug']],
                $property
            );
        }
    }
}
