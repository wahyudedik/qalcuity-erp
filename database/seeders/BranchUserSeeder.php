<?php

namespace Database\Seeders;

use App\Models\Modul\Branch\Branch;
use App\Models\Modul\Auth\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear any existing assignments to prevent duplicates
        DB::table('branch_user')->truncate();
        
        // Get all branches and users
        $branches = Branch::all();
        $users = User::all();
        
        // The first user (Regular User) will be assigned to two branches for testing
        $firstUser = $users->first();
        if ($firstUser && $branches->count() >= 2) {
            $firstUser->branches()->attach($branches->take(2)->pluck('id'));
        }
        
        // The developer user will be assigned to all branches
        $devUser = $users->where('usertype', 'dev')->first();
        if ($devUser) {
            $devUser->branches()->attach($branches->pluck('id'));
        }
        
        // Assign remaining users to random branches
        // Each user gets 1-3 random branches
        $remainingUsers = $users->where('id', '!=', $firstUser->id ?? null)
                               ->where('id', '!=', $devUser->id ?? null);
        
        foreach ($remainingUsers as $user) {
            // Get 1-3 random branches
            $randomBranches = $branches->random(rand(1, min(3, $branches->count())));
            $user->branches()->attach($randomBranches->pluck('id'));
        }
        
        // Ensure each branch has at least one user
        foreach ($branches as $branch) {
            if ($branch->users()->count() === 0) {
                // Find a random user and assign to this branch
                $randomUser = $users->random();
                $randomUser->branches()->attach($branch->id);
            }
        }
    }
}