<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\Modul\Auth\User;
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

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 3',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 4',
            'email' => 'user4@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 5',
            'email' => 'user5@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 6',
            'email' => 'user6@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 7',
            'email' => 'user7@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 8',
            'email' => 'user8@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 9',
            'email' => 'user9@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 10',
            'email' => 'user10@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 11',
            'email' => 'user11@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 12',
            'email' => 'user12@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 13',
            'email' => 'user13@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 14',
            'email' => 'user14@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 15',
            'email' => 'user15@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 16',
            'email' => 'user16@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 17',
            'email' => 'user17@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 18',
            'email' => 'user18@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 19',
            'email' => 'user19@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 20',
            'email' => 'user20@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 21',
            'email' => 'user21@example.com',
            'password' => Hash::make('password'),
            'usertype' => 'user',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user' . Str::random(5),
            'name' => 'User 22',
            'email' => 'user22@example.com',
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