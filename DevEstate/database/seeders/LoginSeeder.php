<?php

namespace Database\Seeders;

use App\Models\Login;
use Illuminate\Database\Seeder;

class LoginSeeder extends Seeder
{
    public function run(): void
    {
        Login::query()->create([
            'headline' => 'Welcome Back',
            'subheadline' => 'Access listings, dashboards, uploads, and management tools.',
            'email_hint' => 'agent@devestate.com',
            'password_hint' => 'password',
            'remember_text' => 'Remember this device',
            'forgot_text' => 'Forgot password?',
        ]);
    }
}
