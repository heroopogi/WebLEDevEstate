<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['name' => 'axel'],
            [
                'full_name' => 'Axel',
                'email' => 'axel@devestate.local',
                'password' => Hash::make('password'),
            ]
        );

        $this->call(PropertySeeder::class);
    }
}
