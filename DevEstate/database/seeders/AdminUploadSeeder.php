<?php

namespace Database\Seeders;

use App\Models\AdminUpload;
use Illuminate\Database\Seeder;

class AdminUploadSeeder extends Seeder
{
    public function run(): void
    {
        AdminUpload::query()->create([
            'recommended_format' => 'JPG / PNG',
            'recommended_resolution' => '2400 x 1600',
            'cover_priority' => 'Exterior Hero Shot',
            'success_message' => '12 images prepared for listing preview.',
            'error_message' => '2 files require higher resolution.',
        ]);
    }
}
