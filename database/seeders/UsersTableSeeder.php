<?php

namespace Database\Seeders;

use App\Models\Modul_Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        // Developer
        User::create([
            'name' => 'Developer',
            'email' => 'dev@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'dev',
            'email_verified_at' => now(),
        ]);
    }
}