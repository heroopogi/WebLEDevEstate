<?php

namespace Database\Seeders;

use App\Models\Home;
use Illuminate\Database\Seeder;

class HomeSeeder extends Seeder
{
    public function run(): void
    {
        Home::query()->create([
            'headline' => 'Find premium spaces designed for modern city life.',
            'subheadline' => 'Browse curated homes, compare neighborhoods, and move from interest to inquiry in one clean flow.',
            'primary_cta' => 'Browse Properties',
            'secondary_cta' => 'View Showcase',
        ]);
    }
}
