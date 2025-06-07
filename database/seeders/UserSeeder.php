<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Boss',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin',
        ]);

        // Maskapai
        User::create([
            'name' => 'Maskapai',
            'email' => 'maskapai@gmail.com',
            'password' => 'maskapai123',
            'role' => 'maskapai',
        ]);

        // User biasa
        User::create([
            'name' => 'Hasan Si Traveler',
            'email' => 'user@gmail.com',
            'password' => '123123123',
            'role' => 'user',
        ]);
    }
}
