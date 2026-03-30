<?php

namespace Database\Seeders;

use App\Models\Dashboard;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    public function run(): void
    {
        Dashboard::query()->insert([
            [
                'metric' => 'Active Listings',
                'value' => '148',
                'note' => 'Gold-highlighted insights make key portfolio metrics easy to scan.',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metric' => 'New Leads',
                'value' => '36',
                'note' => 'Designed for fast review of client activity and conversion momentum.',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'metric' => 'Monthly Revenue',
                'value' => '$2.4M',
                'note' => 'Soft shadows and generous spacing keep enterprise data approachable.',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
