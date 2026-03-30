<?php

namespace Database\Seeders;

use App\Models\Mobile;
use Illuminate\Database\Seeder;

class MobileSeeder extends Seeder
{
    public function run(): void
    {
        Mobile::query()->create([
            'property_name' => 'City Crest Loft',
            'description' => 'Refined city living with concierge access and private lounge amenities.',
            'price' => 540000,
            'tag_one' => 'For Sale',
            'tag_two' => 'Smart Home',
            'active_tab' => 'Home',
        ]);
    }
}
