<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'System Administrator',
                'email' => 'admin@test.com',
                'password' => Hash::make('Admin@123'),
                'user_role' => 'admin',
                'profile_id' => 0,
                'is_active' => true,
            ]
        );
    }
}
