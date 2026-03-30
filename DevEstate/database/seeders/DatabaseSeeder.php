<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            HomeSeeder::class,
            ListingSeeder::class,
            DetailSeeder::class,
            MapSeeder::class,
            AdminUploadSeeder::class,
            DashboardSeeder::class,
            LoginSeeder::class,
            MobileSeeder::class,
        ]);
    }
}
