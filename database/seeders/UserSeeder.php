<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@test.com',
                'password' => Hash::make('Apple@123'),
                'is_admin' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' =>  'User 1',
                'email' => 'user1@test.com',
                'password' => Hash::make('Apple@123'),
                'is_admin' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
