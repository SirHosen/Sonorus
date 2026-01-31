<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Buat admin default
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@sonorus.com',
            'password' => Hash::make('admin123'),
        ]);

        $admin->assignRole('admin');

        // Buat user default
        $user = User::create([
            'name' => 'User',
            'email' => 'user@sonorus.com',
            'password' => Hash::make('user123'),
        ]);

        $user->assignRole('user');
    }
}
