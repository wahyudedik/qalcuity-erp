<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
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
            'username' => 'user' . Str::random(5),
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'Wahyu',
            'email' => 'wahyu@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        // Developer
        User::create([
            'username' => 'dev' . Str::random(5),
            'name' => 'Developer',
            'email' => 'dev@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'dev',
            'email_verified_at' => now(),
        ]);
    }
}