<?php

namespace App\Policies\Modul\Branch;

use App\Models\Modul\Auth\User;
use App\Models\Modul\Branch\Branch;
use Illuminate\Auth\Access\HandlesAuthorization;

class BranchPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true; // All authenticated users can view branches
    }

    public function view(User $user, Branch $branch)
    {
        return true; // All authenticated users can view a branch
    }

    public function create(User $user)
    {
        return true; // All authenticated users can view branches
    }

    public function update(User $user, Branch $branch)
    {
        return true; // All authenticated users can view branches
    }

    public function delete(User $user, Branch $branch)
    {
        return true; // All authenticated users can view branches
    }

    public function assignUsers(User $user, Branch $branch)
    {
        return true; // All authenticated users can view branches
    }
}
